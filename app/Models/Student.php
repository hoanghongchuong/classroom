<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
      'class_id', 'name', 'birthday', 'parent_name', 'phone', 'address', 'gender', 'date_checkin', 'date_checkout', 'status'
    ];

    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = $value ? Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d') : null;
    }
    public function setDateCheckinAttribute($value)
    {
        $this->attributes['date_checkin'] = $value ? Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d') : null;
    }

    public function classes() {
        return $this->hasOne(Classes::class, 'id', 'class_id');
    }
}
