<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;



    protected $table = 'students';

    protected $guard = 'student';

    protected $primaryKey = 'studentId';

    protected $fillable =[
        'studentId',
        'username',
        'password',
        'firstName',
        'lastName',
        'phone',
        'adress',
        'email',
        'birthdate',
        'fathernName',
        'motherName',
        'studentStatus',
        'gender',
    ];


    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function division()
    {
        return $this->hasMany(Division::class , 'DivisionId');
    }

    // public function TheClass()
    // {
    //     return $this->hasMany(TheClass::class , 'DivisionId');
    // }
    


}
