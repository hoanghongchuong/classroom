<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'schedule_date',
        'day_name',
        'start_time',
        'end_time',
        'is_holiday',
        'is_open',
        'note',
    ];

    public function classRoom() {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }

    public function attendance() {
        return $this->hasMany(Attendance::class, 'schedule_id', 'id');
    }
}
