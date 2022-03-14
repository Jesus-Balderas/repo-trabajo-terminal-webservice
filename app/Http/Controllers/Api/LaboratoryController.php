<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function attendants(Laboratory $laboratory)
    {
        return $laboratory->attendant()->get(['id', 'name']);

    }
}
