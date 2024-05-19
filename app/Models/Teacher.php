<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $guard = 'teacher';


    protected $table = 'teachers';

    protected $primaryKey = 'teacher_id';


    
    protected $fillable = [
        'teacher_id',
        'firstname',
        'lastname',
        'phone',
        'adress',
        'email',
        'birthdate',
        'fathername',
        'mothername',
        'gender',
    ];


    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function TheClass()
    {
        return $this->hasMany(Division::class);
    }


    public function Subjects()
    {
        return $this->belongsToMany(Subject::class);
    }





}
