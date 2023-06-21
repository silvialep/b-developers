<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $reviews = Review::where('developer_id', $user->developer->id)->get();
        $ratings = Rating::where('developer_id', $user->developer->id)->get();

        return view('admin.reviews.index', compact('reviews', 'ratings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    use ValidatesRequests;
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'comment' => 'required',
        ]);

        // leggo tutti i dati del form presenti nella request e mi creo un oggetto
        $formData = $request->all();

        // creo un nuovo record del modello Review
        $newReview = new Review();

        // popolo i campi della tabella
        $newReview->fill($formData);
        // slug
        $newReview->slug = Str::slug($formData['name'], '-');

        // salvo il record
        $newReview->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        $user = Auth::user();
        if ($review->developer_id != $user->developer->id) {
            return redirect()->route('admin.reviews.index');
        } else {
            return view('admin.reviews.show', compact('review'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
