<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id', 'student_id','class_id', 'attendance_date', 'status', 'note'
    ];

    public function student() {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
}
