<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use HasFactory;

    // protected $guard = 'teachers';


    protected $table = 'teachers';

    protected $primaryKey = 'teacherid';


    protected $fillable = [
        'teacherid',
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

}
