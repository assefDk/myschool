<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable=[
        'DivisionId',
        'WeeklySchedule',
        'Numberdvs',
    ];

    public function TheClass()
    {
        return $this->hasMany(TheClass::class);
    }

    public function Division() 
    {
        return $this->belongsTo(Teacher::class);
    }

    public function Student() 
    {
        return $this->belongsTo(Student::class);
    }

}
    