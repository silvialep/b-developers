<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Braintree\Gateway;


class Adv_DevController extends Controller
{

    public function create(Advertisement $advertisement)
    {

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
        $clientToken = $gateway->clientToken()->generate();
        return view('admin.advertisements.show', compact('clientToken', 'advertisement'));
    }

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

        if (count($developer->advertisements) > 0) {
            $currentAdv = $advertisement[0]->name;
        } else {
            $currentAdv = 'Nessuna sponsorizzazione';
        }

        $nowDate = date("Y-m-d H:i:s");
        if (count($developer->advertisements) > 0) {
            if ($advertisement[0]->ending_date < $nowDate) {
                $advertisementId = $request->input('advertisement_id');
                $developer->advertisements()->attach($advertisementId, ['starting_date' => $new_starting_date, 'ending_date' => $new_ending_date]);
            } else {
                echo "<script>alert('Hai già una sponsorizzazione attiva')</script>";
                return view('admin.dashboard', compact('developer'));
            }
        } else {
            $advertisementId = $request->input('advertisement_id');
            $developer->advertisements()->attach($advertisementId, ['starting_date' => $new_starting_date, 'ending_date' => $new_ending_date]);
        }

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => 10,
            'paymentMethodNonce' => 'fake-valid-nonce',
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            // pagamento completato
            $transaction = $result->transaction;
            $transaction->status;
            echo "<script>alert('Profilo sponsorizzato correttamente')</script>";
            return view('admin.dashboard', compact('developer'));
            // return redirect()->route('admin.dashboard')->with('message', 'Nuova sponsorizzazione creata correttamente');;

            //dd('completato');
        } else {
            // errore nel pagamento
        }


        // $advertisementId = $request->input('advertisement_id');
        // $developer->advertisements()->attach($advertisementId, ['starting_date' => $new_starting_date, 'ending_date' => $new_ending_date]);


        // echo "<script>alert('Profilo sponsorizzato correttamente')</script>";
        // return view('admin.dashboard', compact('developer'));

    }
}
