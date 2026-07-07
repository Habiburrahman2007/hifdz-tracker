<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $teachers = \App\Models\Teacher::all();
        if ($teachers->isEmpty()) {
            return;
        }

        $students = \App\Models\Student::all();
        foreach ($students as $student) {
            // Assign a random teacher
            $student->teacher_id = $teachers->random()->id;
            $student->save();

            // Setoran data for July 1 to 8 (excluding Friday, July 3)
            $julySetorans = [
                ['date' => '2026-07-01', 'surah_number' => 78, 'surah_name' => 'An-Naba', 'start_ayat' => 1, 'end_ayat' => 10, 'juz' => 30],
                ['date' => '2026-07-02', 'surah_number' => 78, 'surah_name' => 'An-Naba', 'start_ayat' => 11, 'end_ayat' => 20, 'juz' => 30],
                ['date' => '2026-07-04', 'surah_number' => 78, 'surah_name' => 'An-Naba', 'start_ayat' => 21, 'end_ayat' => 30, 'juz' => 30],
                ['date' => '2026-07-05', 'surah_number' => 78, 'surah_name' => 'An-Naba', 'start_ayat' => 31, 'end_ayat' => 40, 'juz' => 30],
                ['date' => '2026-07-06', 'surah_number' => 79, 'surah_name' => 'An-Nazi\'at', 'start_ayat' => 1, 'end_ayat' => 15, 'juz' => 30],
                ['date' => '2026-07-07', 'surah_number' => 79, 'surah_name' => 'An-Nazi\'at', 'start_ayat' => 16, 'end_ayat' => 30, 'juz' => 30],
                ['date' => '2026-07-08', 'surah_number' => 79, 'surah_name' => 'An-Nazi\'at', 'start_ayat' => 31, 'end_ayat' => 46, 'juz' => 30],
            ];

            foreach ($julySetorans as $setoran) {
                // Check if setoran for this student, date, and type already exists to avoid duplicates
                $exists = \Illuminate\Support\Facades\DB::table('setorans')
                    ->where('student_id', $student->id)
                    ->where('date', $setoran['date'])
                    ->where('type', 'sabaq')
                    ->exists();

                if (!$exists) {
                    \Illuminate\Support\Facades\DB::table('setorans')->insert([
                        'student_id' => $student->id,
                        'teacher_id' => $student->teacher_id,
                        'date' => $setoran['date'],
                        'type' => 'sabaq',
                        'juz' => $setoran['juz'],
                        'surah_name' => $setoran['surah_name'],
                        'surah_number' => $setoran['surah_number'],
                        'start_ayat' => $setoran['start_ayat'],
                        'end_ayat' => $setoran['end_ayat'],
                        'line_count' => rand(8, 15),
                        'notes' => null,
                        'attendance' => rand(1, 10) <= 8 ? 'present' : (rand(1, 2) === 1 ? 'late' : 'sick'),
                        'fluency_score' => rand(80, 100),
                        'created_at' => \Carbon\Carbon::parse($setoran['date']),
                        'updated_at' => \Carbon\Carbon::parse($setoran['date']),
                    ]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
