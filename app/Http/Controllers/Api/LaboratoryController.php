<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;


class LaboratoryController extends Controller
{
    
    public function laboratories()
    {
        $laboratories = Laboratory::all(['id','name','classroom','edifice','status','file_path']);
        return $laboratories;
    }
    
    public function attendants(Laboratory $laboratory)
    {
        return $laboratory->attendant()->get();

    }
    
}
