<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'whatsapp',
        'alumnus_of',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }

    public function getGenderLabelAttribute(): string
    {
        return $this->gender === 'male' ? 'Laki-laki' : 'Perempuan';
    }
}
