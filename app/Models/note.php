<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class note extends Model
{
    use HasFactory;

    protected $fillable=[
        'noteId',
        'creator',
        'content',
        'Date_Created',
        'studentId',
    ];



}
