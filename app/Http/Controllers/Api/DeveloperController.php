<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index(Request $request)
    {

        $requestData = $request->all();

        // controllo se dal frontend mi arriva un parametro contenente la specializzazione
        if ($request->has('skill_id') && $requestData['skill_id'] || $request->has('avg') && $requestData['avg']) {
            // mi salvo tutte le skills che hanno quell'name e che corrispondono a quella specializzazione e le associo ai developers
            // $skill = Skill::where('name', 'like', $requestData['skill_name'] . '%')->with('developers')->get();
            $skill = Skill::where('id', $requestData['skill_id'])->with('developers')->get();

            if (count($skill) == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Non esiste questa specializzazione',
                ]);
            }

            // memorizzo i developers in una variabile 
            $developers = $skill[0]->developers;

            // creo un array vuoto che ciclerò per memorizzare i developers_id
            $developers_id = [];


            for ($i = 0; $i < count($developers); $i++) {
                $developers_id[] = $developers[$i]->id;
            }

            // mi creo una variabile contenente solo i developers che hanno l'id a cui appartiene quella skill, memorizzandomi i dati dell'utente 
            $developers = Developer::whereIn('id', $developers_id)->with('user', 'ratings', 'skills', 'reviews')->get();

            // creo una variabile ratingAVG dentro il singolo oggetto developer
            $developers = $developers->each(function ($developer) {
                $developer->ratingAVG = $developer->ratings->avg('rating');
            });

            $avg = $requestData['avg'];
            $developers = $developers->filter(function ($developer) use ($avg) {
                return $developer->ratingAVG >= $avg;
            });


            // SCHEMA RIASSUNTIVO: skill->developer->user
            // dd($skill[0]->name);


            if (count($developers) == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Nessun developer appartenente a questa specializzazione',
                ]);
            }
        } else {
            // in caso contrario, passo tutti i developer (nel caso manchi la skill)
            $developers = Developer::with('ratings', 'skills', 'user', 'reviews')->get();
            // $skill = Skill::where('name', 'Tutte le specializzazioni')->get();

            // creo una variabile ratingAVG dentro il singolo oggetto developer
            $developers = $developers->each(function ($developer) {
                $developer->ratingAVG = $developer->ratings->avg('rating');
            });
        }
        // dd($skill);
        $skills = Skill::all();


        return response()->json([
            'success' => true,
            'results' => $developers,
            'allSkills' => $skills,
            // 'params' => $skill[0]->name,
        ]);
    }


    public function show($slug)
    {
        $developer = Developer::where('slug', $slug)->with('ratings', 'skills', 'user', 'reviews')->first();

        // creo una variabile ratingAVG dentro il singolo oggetto developer
        $developer->ratingAVG = $developer->ratings->avg('rating');

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
