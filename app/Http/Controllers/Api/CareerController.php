<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function careers()
    {
        $careers = Career::all(['id', 'name']);
        return $careers;
    }
}
