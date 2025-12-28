<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS UNTUK AI (TAMBAH DI SINI)
    |--------------------------------------------------------------------------
    */

    // 1. Attendance (rekod harian pensyarah)
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id');
    }

    // 2. Permohonan cuti / hadir rasmi
    public function permohonan()
    {
        return $this->hasMany(Permohonan::class, 'user_id');
    }

    // 3. Baki cuti tahunan
    public function leaveBalance()
    {
        return $this->hasOne(LeaveBalance::class, 'user_id');
    }

    // 4. Profil pensyarah (jika ada table lain seperti lecturers)
    public function lecturerProfile()
    {
        return $this->hasOne(LecturerProfile::class, 'user_id');
    }
}
