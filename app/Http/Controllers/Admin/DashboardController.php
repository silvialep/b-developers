<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function home() {

        $user = Auth::user();

        $developer = $user->developer;


        return view('admin.dashboard', compact('developer'));
    }


}


