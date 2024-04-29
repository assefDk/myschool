<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;

class Mentor extends Authenticatable
{
    use HasFactory;


    // protected $guard = 'mentor';

    protected $table = 'mentors';

    protected $primaryKey = 'mentorid';
    
    protected $fillable = [
        "mentorid",
        "firstname",
        "lastname",
        "phone",
        "address",
        "email",
        "birthdate",
        "fathername",
        "mothername",
        "gender",
    ];


    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
