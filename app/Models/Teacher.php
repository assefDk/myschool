<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
//use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Teacher extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    protected $guard = 'teacher';


    protected $table = 'teachers';

    protected $primaryKey = 'idT';


    
    protected $fillable = [
        'idT',
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
        return $this->belongsToMany(Subject::class,'subject_teacher','idT','idS');
    }


    public function Divisions()
    {
        return $this->belongsToMany(Division::class,'divisions_teachers','idT','DivisionId');
    }

    
    public function subject_teacher (): HasMany
    {
        return $this->hasMany(Subject_Teacher::class,'id');
    }


}

