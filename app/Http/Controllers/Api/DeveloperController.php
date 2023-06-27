<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class DeveloperController extends Controller
{
    public function index(Request $request)
    {

        $requestData = $request->all();

        // controllo se dal frontend mi arriva un parametro contenente la specializzazione
        if ($request->has('skill_id') && $requestData['skill_id'] || $request->has('avg') && $requestData['avg'] || $request->has('numRevs') && $requestData['numRevs']) {
            // mi salvo tutte le skills che hanno quell'name e che corrispondono a quella specializzazione e le associo ai developers
            // $skill = Skill::where('name', 'like', $requestData['skill_name'] . '%')->with('developers')->get();
            $skill = Skill::where('id', $requestData['skill_id'])->with('developers')->get();

            if (count($skill) == 0) {
                // return response()->json([
                //     'success' => false,
                //     'error' => 'Non esiste questa specializzazione',
                // ]);
                $skill = Skill::all();
                $developers = Developer::with('user', 'ratings', 'skills', 'reviews', 'advertisements')->get();
            } else {
                $developers = $skill[0]->developers;
                // memorizzo i developers in una variabile 

                // creo un array vuoto che ciclerò per memorizzare i developers_id
                $developers_id = [];


                for ($i = 0; $i < count($developers); $i++) {
                    $developers_id[] = $developers[$i]->id;
                }

                // mi creo una variabile contenente solo i developers che hanno l'id a cui appartiene quella skill, memorizzandomi i dati dell'utente 
                $developers = Developer::whereIn('id', $developers_id)
                    ->with('user', 'ratings', 'skills', 'reviews', 'advertisements')
                    ->get();
            }


            // creo un array vuoto che ciclerò per memorizzare i developers_id
            $developers_id = [];


            for ($i = 0; $i < count($developers); $i++) {
                $developers_id[] = $developers[$i]->id;
            }


            $numRevs = $requestData['numRevs'];
            // Ordinare per numero recensioni
            if ($numRevs == 1) {
                // $developers = Developer::whereIn('id', $developers_id)
                //     ->withCount('reviews')
                //     ->with('user', 'ratings', 'skills', 'reviews', 'advertisements')
                //     ->orderBy('reviews_count', 'desc')
                //     ->get();






                $sponsoredDevelopers = $developers = Developer::whereIn('id', $developers_id)
                    ->withCount('reviews')
                    ->with('user', 'ratings', 'skills', 'reviews', 'advertisements')
                    ->whereHas('advertisements', function (Builder $query) {
                        $query->whereRaw('(now() between starting_date and ending_date)');
                    })
                    ->orderBy('reviews_count', 'desc')
                    ->get();

                $notSponsoredDevelopers = $developers = Developer::whereIn('id', $developers_id)
                    ->withCount('reviews')
                    ->with('user', 'ratings', 'skills', 'reviews', 'advertisements')
                    ->whereDoesntHave('advertisements', function (Builder $query) {
                        $query->whereRaw('(now() between starting_date and ending_date)');
                    })
                    ->orderBy('reviews_count', 'desc')
                    ->get();

                $developers = $sponsoredDevelopers->concat($notSponsoredDevelopers)->values();


                $developers = $developers->each(function ($developer) {

                    $developer->sponsor = $developer->advertisements->filter(function ($adv) {
                        $nowDate = date("Y-m-d H:i:s");
                        return $adv->pivot->ending_date >= $nowDate;
                    });
                });
            } elseif ($numRevs == 2) {
                // $developers = Developer::whereIn('id', $developers_id)
                //     ->withCount('reviews')
                //     ->with('user', 'ratings', 'skills', 'reviews', 'advertisements')
                //     ->orderBy('reviews_count', 'asc')
                //     ->get();
                $sponsoredDevelopers = $developers = Developer::whereIn('id', $developers_id)
                    ->withCount('reviews')
                    ->with('user', 'ratings', 'skills', 'reviews', 'advertisements')
                    ->whereHas('advertisements', function (Builder $query) {
                        $query->whereRaw('(now() between starting_date and ending_date)');
                    })
                    ->orderBy('reviews_count', 'asc')
                    ->get();

                $notSponsoredDevelopers = $developers = Developer::whereIn('id', $developers_id)
                    ->withCount('reviews')
                    ->with('user', 'ratings', 'skills', 'reviews', 'advertisements')
                    ->whereDoesntHave('advertisements', function (Builder $query) {
                        $query->whereRaw('(now() between starting_date and ending_date)');
                    })
                    ->orderBy('reviews_count', 'asc')
                    ->get();

                $developers = $sponsoredDevelopers->concat($notSponsoredDevelopers)->values();


                $developers = $developers->each(function ($developer) {

                    $developer->sponsor = $developer->advertisements->filter(function ($adv) {
                        $nowDate = date("Y-m-d H:i:s");
                        return $adv->pivot->ending_date >= $nowDate;
                    });
                });
            }


            // creo una variabile ratingAVG dentro il singolo oggetto developer
            $developers = $developers->each(function ($developer) {
                $developer->ratingAVG = $developer->ratings->avg('rating');
                $developer->numReviews = $developer->reviews->count('id');
            });

            $avg = $requestData['avg'];
            $developers = $developers->filter(function ($developer) use ($avg) {
                return $developer->ratingAVG >= $avg;
            });

            // SCHEMA RIASSUNTIVO: skill->developer->user

            if (count($developers) == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Nessun developer appartenente a questa specializzazione',
                ]);
            }
        } else {
            // in caso contrario, passo tutti i developer (nel caso manchi la skill)
            $sponsoredDevelopers = Developer::with('ratings', 'skills', 'user', 'reviews', 'advertisements')->whereHas('advertisements', function ($q) {
                $nowDate = date("Y-m-d H:i:s");
                $q->where('ending_date', '>=', $nowDate);
            })->get();

            $notSponsoredDevelopers = Developer::with('ratings', 'skills', 'user', 'reviews', 'advertisements')->whereDoesntHave('advertisements', function ($q) {
                $nowDate = date("Y-m-d H:i:s");
                $q->where('ending_date', '>=', $nowDate);
            })->get();


            // creo una variabile ratingAVG dentro il singolo oggetto developer
            $sponsoredDevelopers = $sponsoredDevelopers->each(function ($developer) {
                $developer->ratingAVG = $developer->ratings->avg('rating');
                $developer->numReviews = $developer->reviews->count('id');

                $developer->sponsor = $developer->advertisements->filter(function ($adv) {
                    $nowDate = date("Y-m-d H:i:s");
                    return $adv->pivot->ending_date >= $nowDate;
                });
            });

            $notSponsoredDevelopers = $notSponsoredDevelopers->each(function ($developer) {
                $developer->ratingAVG = $developer->ratings->avg('rating');
                $developer->numReviews = $developer->reviews->count('id');

                $developer->sponsor = $developer->advertisements->filter(function ($adv) {
                    $nowDate = date("Y-m-d H:i:s");
                    return $adv->pivot->ending_date >= $nowDate;
                });
            });
            $developers = [$sponsoredDevelopers, $notSponsoredDevelopers];
        }

        $skills = Skill::all();

        return response()->json([
            'success' => true,
            'results' => $developers,
            'allSkills' => $skills,
        ]);
    }


    public function show($slug)
    {
        $developer = Developer::where('slug', $slug)->with('ratings', 'skills', 'user', 'reviews')->first();

        // creo una variabile ratingAVG dentro il singolo oggetto developer
        $developer->ratingAVG = $developer->ratings->avg('rating');
        $developer->numReviews = $developer->reviews->count('id');

        if ($developer) {
            return response()->json([
                'success' => true,
                'developer' => $developer,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Il developer non esiste',
            ]);
        }
    }
}
