<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'classroom',
        'edifice',
        'computers',
        'file_path',
        'attendant_id'
    ];

    protected $hidden = [
        
        'attendant_id',
        'created_at',
        'updated_at',
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
