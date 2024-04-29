<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'ClassId',
        'ClassName',
    ];


    public function Section()
    {
        return $this->hasMany(Major::class);
    }  
    

    public function Division() 
    {
        return $this->belongsTo(Division::class);
    }  
    

}
