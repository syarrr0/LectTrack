<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    protected $table = 'attendances';

    protected $fillable = [
        'lecturer_id',
        'date_submit',
        'date_end',
        'selection',
        'time',
        'location',
        'remarks'
    ];

    public $timestamps = false;

    // Relationship kepada lecturer
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    // Format tarikh mudah AI
    public function getDateSubmitFormattedAttribute()
    {
        return Carbon::parse($this->date_submit)->format('d M Y');
    }

    public function getDateEndFormattedAttribute()
    {
        return Carbon::parse($this->date_end)->format('d M Y');
    }
    public function scopeLecturer($query, $lecturerId)
{
    return $query->where('lecturer_id', $lecturerId);
}

public function getTotalDaysAttribute()
{
    return \Carbon\Carbon::parse($this->date_submit)->diffInDays(\Carbon\Carbon::parse($this->date_end)) + 1;
}
}
