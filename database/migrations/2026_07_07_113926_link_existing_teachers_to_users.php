<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teachers = \Illuminate\Support\Facades\DB::table('teachers')->whereNull('user_id')->get();
        foreach ($teachers as $teacher) {
            // Find user by matching name (e.g. "Ustadz Ahmad Fauzi" or "Ahmad Fauzi")
            $cleanTeacherName = str_replace(['Ustadz ', 'Ustadzah '], '', $teacher->name);
            
            $user = \Illuminate\Support\Facades\DB::table('users')
                ->where('role', 'ustadz')
                ->where(function ($query) use ($teacher, $cleanTeacherName) {
                    $query->where('name', $teacher->name)
                          ->orWhere('name', $cleanTeacherName)
                          ->orWhere('email', 'like', strtolower(explode(' ', $cleanTeacherName)[0]) . '@%');
                })
                ->first();

            if ($user) {
                \Illuminate\Support\Facades\DB::table('teachers')
                    ->where('id', $teacher->id)
                    ->update(['user_id' => $user->id]);
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
