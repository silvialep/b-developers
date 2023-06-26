<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Adv_DevController extends Controller
{
    public function saveAdv(Request $request)
    {
        $user = Auth::user();
        $developer = $user->developer;
        $id = $developer->id;
        
        $new_starting_date = date("Y-m-d H:i:s");

        if ($request->advertisement_id == 1) {
            $new_ending_date = date("Y-m-d H:i:s", strtotime('+24 hours'));
        } else if ($request->advertisement_id == 2) {
            $new_ending_date = date("Y-m-d H:i:s", strtotime('+72 hours'));
        } else if ($request->advertisement_id == 3) {
            $new_ending_date = date("Y-m-d H:i:s", strtotime('+144 hours'));
        }

        $ratingsAvg = Rating::where('developer_id', $id)->avg('rating');
        $ratingsNumber = Rating::where('developer_id', $id)->count();
        $advertisement = Advertisement::join('advertisement_developer', 'advertisement_developer.advertisement_id', '=', 'advertisements.id')
        ->where('developer_id', $id)
            ->orderByDesc('ending_date')
            ->get();
        
        if(count($developer->advertisements) > 0) {
            $currentAdv = $advertisement[0]->name;

        } else {
            $currentAdv = 'Nessuna sponsorizzazione';
        }


        $advertisementId = $request->input('advertisement_id');
        $developer->advertisements()->attach($advertisementId, ['starting_date' => $new_starting_date, 'ending_date' => $new_ending_date]);

        
        echo "<script>alert('Profilo sponsorizzato correttamente')</script>";
        return view('admin.dashboard', compact('developer'));
        
    }
}
