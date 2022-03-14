<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'name',
    ];
    
    public function students()
    {
        //UNA CARRERA SE ASOCIA CON MUCHOS ALUMNOS
        return $this->hasMany(Student::class);
    }
}
