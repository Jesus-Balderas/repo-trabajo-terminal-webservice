<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create()
    {
        $laboratories = Laboratory::all();
        return view('appointments.create', compact('laboratories'));
    }
}
