<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;


    protected $fillable = [
        'MajorId',
        'name',
        'MajorId'
    ];

    public function TheClass() 
    {
        return $this->belongsTo(TheClass::class,'ClassId');
    } 
    
    public function Student() 
    {
        return $this->belongsTo(Student::class);
    } 


}
