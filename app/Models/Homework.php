<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $primaryKey = 'IdHomework';


    protected $fillable = [
        'IdHomework',
        'creator',
        'file',
        'subject',
        'startHomework',
        'endHomework',
        'idS',
    ];


}
