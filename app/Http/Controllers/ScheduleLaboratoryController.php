<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class ScheduleLaboratoryController extends Controller
{
    public function index()
    {
        return view('scheduleLaboratories.index');
    }

    public function create()
    {
        $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
        $laboratories = Laboratory::all(['id', 'name']);
        return view('scheduleLaboratories.create', compact('laboratories', 'days'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

    }
}
