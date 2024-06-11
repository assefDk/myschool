<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcment extends Model
{
    use HasFactory;

    protected $primaryKey = 'IdAnnouncment';


    protected $fillable=[
        'IdAnnouncment',
        'creator',
        'content'
    ];

    public function Division()
    {
        return $this->belongsToMany(Division::class,'announcments_divisions','IdAnnouncment','DivisionId');
    }



}
