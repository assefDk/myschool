<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheClass extends Model
{
    use HasFactory;


    protected $guarded = [ ];
    protected $fillable = [
        'ClassId',
        'ClassName',
        // 'MajorId',
        // 'name',
    ];


    public function Major()
    {
        return $this->hasMany(Major::class , 'MajorId');
    }  
    

    public function Division() 
    {
        return $this->belongsTo(Division::class);
    }  
    
    public function Student() 
    {
        return $this->belongsTo(Student::class);
    } 
    


    //new
    public function Subject() 
    {
        return $this->belongsTo(Subject::class);
    }  







}

    // protected $fillable = ['ClassName', 'MajorId', 'name'];

    // public function major()
    // {
    //     return $this->belongsTo(Major::class, 'MajorId');
    // }