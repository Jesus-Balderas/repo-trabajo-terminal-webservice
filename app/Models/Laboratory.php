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
        'file_path',
    ];

    public function attendants()
    {
        //UN LABORATORIO TIENE VARIOS ENCARGADOS
        return $this->hasMany(Attendant::class);
    }
}
