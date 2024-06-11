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


    protected $primaryKey = 'DivisionId';


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



    public function Teachers()
    {
        return $this->belongsToMany(Teacher::class,'divisions_teachers','DivisionId','idT');
    }

    public function Announcment()
    {
        return $this->belongsToMany(Announcment::class,'announcments_divisions','DivisionId','IdAnnouncment');
    }



}
