<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index(){
        $developers = Developer::all();

        return response()->json([
            'success' => true,
            'results' => $developers
        ]);
    }
}
