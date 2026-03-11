<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'date',
        'type',
        'juz',
        'surah_name',
        'surah_number',
        'start_ayat',
        'end_ayat',
        'line_count',
        'notes',
        'attendance',
        'fluency_score',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return match($this->type) {
            'sabaq' => 'Sabaq',
            'sabqi' => 'Sabqi',
            'manzil' => 'Manzil',
            default => $this->type,
        };
    }

    public function getAttendanceLabelAttribute(): string
    {
        return match($this->attendance) {
            'present' => 'Hadir',
            'excused' => 'Izin',
            'late' => 'Terlambat',
            'alpha' => 'Alpha',
            'sick' => 'Sakit',
            default => $this->attendance,
        };
    }

    public function getAttendanceBadgeAttribute(): string
    {
        return match($this->attendance) {
            'present' => 'success',
            'excused' => 'warning',
            'late' => 'info',
            'alpha' => 'danger',
            'sick' => 'secondary',
            default => 'secondary',
        };
    }
}
