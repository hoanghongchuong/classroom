<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'name',
        'sku',
        'start_time',
        'end_time',
        'tuition_fee',
        'description',
        'status'
    ];

    public function teacher() {
        return $this->hasOne(User::class, 'id', 'teacher_id');
    }

    public function students() {
        return $this->hasMany(Student::class, 'class_id', 'id');
    }
}
