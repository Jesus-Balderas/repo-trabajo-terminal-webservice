<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;


class LaboratoryController extends Controller
{
    
    public function laboratories()
    {
        $laboratories = Laboratory::all();
        return $laboratories;
    }
    
    public function attendants(Laboratory $laboratory)
    {
        return $laboratory->attendant()->get(['id', 'name']);

    }
    
}
