<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function home() {

        $developers = Developer::all();

        $developer_id = Auth::id();

        $developer = Developer::where('user_id', $developer_id)->get();


        return view('admin.dashboard', compact('developer'));
    }
}


