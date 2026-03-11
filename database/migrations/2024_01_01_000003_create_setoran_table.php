<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('teacher_id')->nullable()->constrained('teachers')->nullOnDelete();
            $table->date('date');
            $table->enum('type', ['sabaq', 'sabqi', 'manzil']);
            $table->integer('juz')->between(1, 30);
            $table->string('surah_name');
            $table->integer('surah_number');
            $table->integer('start_ayat');
            $table->integer('end_ayat');
            $table->integer('line_count')->default(0);
            $table->text('notes')->nullable();
            $table->enum('attendance', ['present', 'excused', 'late', 'alpha', 'sick'])->default('present');
            $table->integer('fluency_score')->default(100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('setorans');
    }
};
