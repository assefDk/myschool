<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Secretary extends Authenticatable
{

    use HasApiTokens,HasFactory, Notifiable;

    protected $guard = ['admin','secretary'];
    
    protected $table = 'secretaries';

    protected $primaryKey = 'secretaryid';
    
    protected $fillable=[
        "secretaryid",
        "firstname",
        "lastname",
        "username",
        "password",
        "phone",
        "address",
        "email",
        "birthdate",
        "fathername",
        "mothername",
        "isadmin",
        "gender",
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



    public function run(): void
    {
        Secretary::factory()
            ->count(1)
            ->hasPosts(1)
            ->create();
    }


}
