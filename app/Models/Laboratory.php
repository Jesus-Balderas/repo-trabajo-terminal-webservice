<?php

namespace App\Models;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'classroom',
        'edifice',
        'file_path',
    ];

    public function attendant()
    {
        //UN LABORATORIO PERTENECE A UN ENCARGADO
        return $this->belongsTo(Attendant::class);
    }

    public function scheduleLaboratories()
    {
        //UN LABORATORIO TIENE VARIOS HORARIOS
        return $this->hasMany(ScheduleLaboratory::class);
    }
}
