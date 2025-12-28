<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
class Lecturer extends Model
{
    protected $table = 'lecturers';

    protected $fillable = [
        'nama',
        'department',
        'identity',
        'phone',
        'email',
        'image',
        'password'
    ];

    public $timestamps = false;

    // Relationship ke attendance (AI perlukan)
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'lecturer_id');
    }

public function latestAttendance()
{
    return $this->hasOne(Attendance::class)->latestOfMany();
}


}
