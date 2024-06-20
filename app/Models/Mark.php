<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mark extends Model
{
    use HasFactory;


    protected $fillable = [
        'mid',
        'in_class',
        'homework',
        'final',
        'student_id',
        'sub_tea_id',
    ];






    public function subject_teacher() : BelongsTo
    {
        return $this->belongsTo(Subject_Teacher::class,'sub_tea_id');
    }


    public function Student() : BelongsTo
    {
        return $this->belongsTo(Student::class,'student_id');
    } 



}

