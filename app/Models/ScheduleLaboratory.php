<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleLaboratory extends Model
{
    use HasFactory;

    protected $fillable = [

        'day',
        'time_start',
        'time_end',
        'laboratory_id'
    ];

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class);
    }
}
