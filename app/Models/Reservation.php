<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'laboratory_id',
        'attendant_id',
        'computer_id',
        'student_id',
        'schedule_date',
        'schedule_time'
    ];

    protected $hidden = [
        'laboratory_id',
        'attendant_id',
        'computer_id',
        'student_id',
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function attendant()
    {
        return $this->belongsTo(Attendant::class);
    }

    public function computer()
    {
        return $this->belongsTo(Computer::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }

}
