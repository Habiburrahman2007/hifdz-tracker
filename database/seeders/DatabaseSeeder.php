<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Setoran;
use App\Models\Setting;
use App\Helpers\QuranHelper;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Settings
        Setting::set('institution_name', 'Pesantren Darul Ilmi');
        Setting::set('theme', 'emerald');
        Setting::set('logo', '');

        // Teachers
        $teachers = $this->seedTeachers();

        // Students
        $students = $this->seedStudents($teachers);

        // Setorans (1 year daily data)
        $this->seedSetorans($students, $teachers);
    }

    private function seedTeachers(): array
    {
        $teacherData = [
            ['name' => 'Ustadz Ahmad Fauzi', 'gender' => 'male', 'whatsapp' => '081234567001', 'alumnus_of' => 'Pesantren Al-Quran Bandung'],
            ['name' => 'Ustadz Ridwan Hasan', 'gender' => 'male', 'whatsapp' => '081234567002', 'alumnus_of' => 'Pesantren Tahfidz Surabaya'],
            ['name' => 'Ustadzah Siti Aminah', 'gender' => 'female', 'whatsapp' => '081234567003', 'alumnus_of' => 'Pesantren Ar-Risalah Solo'],
            ['name' => 'Ustadz Muhammad Yusuf', 'gender' => 'male', 'whatsapp' => '081234567004', 'alumnus_of' => 'Pesantren Darul Ulum Jombang'],
            ['name' => 'Ustadzah Fatimah Zahra', 'gender' => 'female', 'whatsapp' => '081234567005', 'alumnus_of' => 'Pesantren Al-Munawwir Yogyakarta'],
        ];

        $teachers = [];
        foreach ($teacherData as $data) {
            $teachers[] = Teacher::create($data);
        }
        return $teachers;
    }

    private function seedStudents(array $teachers): array
    {
        $maleNames = [
            'Ahmad Rizki', 'Muhammad Fadli', 'Ibnu Hajar', 'Zaid Mubarak', 'Umar Faruq',
            'Hasan Bashri', 'Yahya Muharram', 'Idris Salim', 'Yusuf Habibi', 'Ibrahim Khalil',
            'Anas Malik', 'Hudzaifah Ali', 'Bilal Rahman', 'Salman Farisi', 'Muadz Jabal',
            'Abdullah Salam', 'Faris Al-Amin', 'Rafi Alfarisi', 'Naufal Hidayat', 'Zikri Ramadhan',
            'Ilham Rabbani', 'Kahfi Mubarak', 'Raihan Akbar', 'Arkan Firdaus', 'Anwar Hasanah',
            'Daffa Maulana', 'Dzaki Aminullah', 'Faqih Islami', 'Ghazi Badrullah', 'Hamid Siddiq',
        ];

        $femaleNames = [
            'Fatimah Azzahra', 'Aisyah Radhiyah', 'Khadijah Nurhaliza', 'Maryam Saleha', 'Zainab Hanifah',
            'Hafsah Azzahra', 'Ruqayyah Salimah', 'Asma Hanifah', 'Rafika Nabilah', 'Siti Rahmah',
            'Nazwa Syafiqah', 'Fathiyyah Mumtaz', 'Hana Kamilah', 'Yasmeen Zahiyah', 'Nur Halimah',
            'Qonita Maulida', 'Rania Hasanah', 'Salwa Muhibbah', 'Tsabitha Lathifah', 'Ummu Kultsum',
        ];

        $halaqahClasses = ['Halaqah Al-Fatih', 'Halaqah Al-Ikhlas', 'Halaqah An-Nuur', 'Halaqah Al-Fajr', 'Halaqah Az-Zumar'];
        $grades = [7, 7, 8, 8, 9, 9, 10, 10, 11, 12];

        $students = [];
        $allNames = array_merge($maleNames, $femaleNames);
        $maleCount = count($maleNames);

        for ($i = 0; $i < 50; $i++) {
            $name = $allNames[$i];
            $gender = $i < $maleCount ? 'male' : 'female';
            $grade = $grades[$i % count($grades)];
            $teacher = $teachers[$i % count($teachers)];
            $halaqah = $halaqahClasses[$i % count($halaqahClasses)];

            $students[] = Student::create([
                'name' => $name,
                'gender' => $gender,
                'grade' => $grade,
                'halaqah_class' => $halaqah,
                'nisn' => '10' . str_pad($i + 1, 8, '0', STR_PAD_LEFT),
                'teacher_id' => $teacher->id,
                'parent_name' => ($gender === 'male' ? 'Bapak' : 'Ibu') . ' ' . explode(' ', $name)[0],
                'parent_whatsapp' => '0812' . rand(10000000, 99999999),
            ]);
        }
        return $students;
    }

    private function seedSetorans(array $students, array $teachers): void
    {
        $surahs = QuranHelper::getSurahs();
        $startDate = Carbon::now()->subYear();
        $endDate = Carbon::now()->subDay();

        // Assign target juz per student (1–25)
        $studentTargets = [];
        foreach ($students as $idx => $student) {
            $studentTargets[$student->id] = ($idx % 25) + 1;
        }

        foreach ($students as $student) {
            $batch = [];
            $targetJuz = $studentTargets[$student->id];
            $teacherId = $student->teacher_id;

            // Get all surahs up to targetJuz
            $juzSurahs = array_values(array_filter($surahs, fn($s) => $s[2] <= $targetJuz));

            if (empty($juzSurahs)) continue;

            $currentSurahIdx = 0;
            $currentAyat = 1;
            $date = $startDate->copy();
            $linesPerDay = max(8, (int)($targetJuz * 300 / 250)); // spread lines over ~250 work days

            while ($date <= $endDate) {
                // Skip Fridays
                if ($date->dayOfWeek === Carbon::FRIDAY) {
                    $date->addDay();
                    continue;
                }

                $attendance = $this->randomAttendance();
                $dateStr = $date->format('Y-m-d');

                if (in_array($attendance, ['present', 'late']) && $currentSurahIdx < count($juzSurahs)) {
                    $surah = $juzSurahs[$currentSurahIdx];
                    $linesNow = rand(max(5, $linesPerDay - 5), $linesPerDay + 8);
                    $endAyat = min($surah[3], $currentAyat + rand(2, 7));

                    // Sabaq
                    $batch[] = [
                        'student_id' => $student->id,
                        'teacher_id' => $teacherId,
                        'date' => $dateStr,
                        'type' => 'sabaq',
                        'juz' => $surah[2],
                        'surah_name' => $surah[1],
                        'surah_number' => $surah[0],
                        'start_ayat' => $currentAyat,
                        'end_ayat' => $endAyat,
                        'line_count' => $linesNow,
                        'notes' => null,
                        'attendance' => $attendance,
                        'fluency_score' => 100 - (rand(0, 5) * 5),
                        'created_at' => $date,
                        'updated_at' => $date,
                    ];

                    $currentAyat = $endAyat + 1;
                    if ($currentAyat > $surah[3]) {
                        $currentSurahIdx++;
                        $currentAyat = 1;
                    }

                    // Sabqi (50% chance)
                    if ($currentSurahIdx > 0 && rand(0, 1) === 1) {
                        $revIdx = max(0, $currentSurahIdx - rand(1, min(3, $currentSurahIdx)));
                        $revSurah = $juzSurahs[$revIdx];
                        $batch[] = [
                            'student_id' => $student->id,
                            'teacher_id' => $teacherId,
                            'date' => $dateStr,
                            'type' => 'sabqi',
                            'juz' => $revSurah[2],
                            'surah_name' => $revSurah[1],
                            'surah_number' => $revSurah[0],
                            'start_ayat' => 1,
                            'end_ayat' => $revSurah[3],
                            'line_count' => rand(10, 20),
                            'notes' => null,
                            'attendance' => $attendance,
                            'fluency_score' => 100 - (rand(0, 3) * 5),
                            'created_at' => $date,
                            'updated_at' => $date,
                        ];
                    }

                    // Manzil (25% chance)
                    if ($currentSurahIdx > 3 && rand(0, 3) === 0) {
                        $mIdx = rand(0, max(0, $currentSurahIdx - 4));
                        $mSurah = $juzSurahs[$mIdx];
                        $batch[] = [
                            'student_id' => $student->id,
                            'teacher_id' => $teacherId,
                            'date' => $dateStr,
                            'type' => 'manzil',
                            'juz' => $mSurah[2],
                            'surah_name' => $mSurah[1],
                            'surah_number' => $mSurah[0],
                            'start_ayat' => 1,
                            'end_ayat' => $mSurah[3],
                            'line_count' => rand(20, 40),
                            'notes' => null,
                            'attendance' => $attendance,
                            'fluency_score' => 100 - (rand(0, 2) * 5),
                            'created_at' => $date,
                            'updated_at' => $date,
                        ];
                    }
                } else {
                    // Absent record (only if absent)
                    if (!in_array($attendance, ['present', 'late'])) {
                        $surah = $juzSurahs[min($currentSurahIdx, count($juzSurahs) - 1)];
                        $batch[] = [
                            'student_id' => $student->id,
                            'teacher_id' => $teacherId,
                            'date' => $dateStr,
                            'type' => 'sabaq',
                            'juz' => $surah[2],
                            'surah_name' => $surah[1],
                            'surah_number' => $surah[0],
                            'start_ayat' => max(1, $currentAyat),
                            'end_ayat' => max(1, $currentAyat),
                            'line_count' => 0,
                            'notes' => null,
                            'attendance' => $attendance,
                            'fluency_score' => 0,
                            'created_at' => $date,
                            'updated_at' => $date,
                        ];
                    }
                }

                // Flush every 200 records
                if (count($batch) >= 200) {
                    Setoran::insert($batch);
                    $batch = [];
                }

                $date->addDay();
            }

            if (!empty($batch)) {
                Setoran::insert($batch);
            }
        }
    }

    private function randomAttendance(): string
    {
        $rand = rand(1, 100);
        if ($rand <= 78) return 'present';
        if ($rand <= 85) return 'late';
        if ($rand <= 89) return 'excused';
        if ($rand <= 94) return 'sick';
        return 'alpha';
    }
}
