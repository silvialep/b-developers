<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){

        $developers = Developer::all();

        return view('home', compact('developers'));
    }

    public function show(Developer $developer){
        
        return view('Guest.Developer.show', compact('developer'));
    }
}
