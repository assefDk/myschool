<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subject_Teacher extends Model
{
    use HasFactory;
    protected $table = 'subject_teacher';
    protected $primaryKey = 'sub_tea_id';


    protected $fillable=[
        'idS',
        'idT',
        'DivisionId'
    ];







    public function subject (): BelongsTo
    {
        return $this->belongsTo(Subject::class,'idS');
    }

    public function subjectn (): BelongsTo
    {
        return $this->belongsTo(Subject::class,'idS')->wherenull('belongs_to');
    }

    public function teacher (): BelongsTo
    {
        return $this->belongsTo(Teacher::class,'idT');
    }

    // public function division (): BelongsTo
    // {
    //     return $this->belongsTo(Division::class,'DivisionId');
    // }

    public function mark (): HasOne
    {
        return $this->hasOne(Mark::class,'sub_tea_id');
    }

    

}