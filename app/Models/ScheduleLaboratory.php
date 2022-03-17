<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleLaboratory extends Model
{
    use HasFactory;

    protected $fillable = [
            'day',
            'active',
            'one_time',
            'two_time',
            'three_time',
            'four_time',
            'five_time',
            'six_time',
            'seven_time',
            'eight_time',
            'nine_time',
            'laboratory_id'
    ];

    public function laboratory()
    {
        //UN HORARIO SE ASOCIA CON UN LABORATORIO
        return $this->belongsTo(Laboratory::class);
    }
    
}
