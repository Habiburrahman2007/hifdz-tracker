<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'grade',
        'halaqah_class',
        'nisn',
        'teacher_id',
        'parent_name',
        'parent_whatsapp',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }

    public function getGenderLabelAttribute(): string
    {
        return $this->gender === 'male' ? 'Laki-laki' : 'Perempuan';
    }

    /**
     * Get total lines memorized (sabaq only for progress)
     */
    public function getTotalLinesAttribute(): int
    {
        return $this->setorans()->where('type', 'sabaq')->sum('line_count');
    }

    /**
     * Total pages (15 lines = 1 page)
     */
    public function getTotalPagesAttribute(): float
    {
        return round($this->total_lines / 15, 1);
    }

    /**
     * Total juz (20 pages = 1 juz)
     */
    public function getTotalJuzAttribute(): float
    {
        return round($this->total_pages / 20, 2);
    }

    /**
     * Progress percentage toward 30 juz
     */
    public function getProgressPercentageAttribute(): float
    {
        return min(100, round(($this->total_juz / 30) * 100, 1));
    }
}
