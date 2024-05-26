<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;


    protected $primaryKey = 'idS';


    protected $fillable = [
        'idS',
        'sub_name',
        'max',
        'min',
        'MajorId',
        'ClassId',
    ];


    public function TheClass(){
        return $this->hasMany(TheClass::class , 'ClassId');
    }


    public function Teachers(){
        return $this->belongsToMany(Teacher::class,'subject_teacher','idS','idT');
    }


}
