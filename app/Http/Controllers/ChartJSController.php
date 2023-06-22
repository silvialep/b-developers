<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as DB;

class ChartJSController extends Controller
{
    public function index()
    {

        // memorizzo lo user collegato
        $user = Auth::user();
        // memorizzo il profilo riferito allo user loggato
        $devLogged = $user->developer->id;
        // MONTHNAME(created_at)
        $messages = Message::select(DB::raw("COUNT(*) as count"), DB::raw("DATE_FORMAT(created_at, '%m/%Y') as month_name"))
        ->where('developer_id', $devLogged)
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("month_name"))
        // ->orderBy('id','ASC')
        ->pluck('count', 'month_name');
        
        $labels = $messages->keys();
        $data = $messages->values();
              
        return view('admin.statistics.chart', compact('labels', 'data'));
    }
}
