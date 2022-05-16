<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FirebaseController extends Controller
{
    public function postTokenStudent(Request $request)
    {
        $student = Auth::guard('api-student')->user();
        
        if ($request->has('device_token')) {
            $student->device_token = $request->input('device_token');
            $student->save();
        }
        
    }
}
