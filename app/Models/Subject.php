<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $primaryKey = 'idS';

    protected $fillable = [
        'idS',
        'sub_name',
        'max',
        'min',
        'max_mid',
        'max_in_class',
        'max_homework',
        'max_final',
        'MajorId',
        'ClassId',
    ];







    public function TheClass(){
        return $this->hasMany(TheClass::class , 'ClassId');
    }




    public function Teachers(){
        return $this->belongsToMany(Teacher::class,'subject_teacher','idS','idT');
    }


    public function Divisions()
    {
        // return $this->belongsToMany(Division::class,'subject_teacher','idS','DivisionId');
        return $this->belongsToMany(Division::class);
    }





}