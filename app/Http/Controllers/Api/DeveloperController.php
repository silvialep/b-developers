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

        if ($request->has('skill_id') && $requestData['skill_id']) {
            // $developers = Developer::where('skill_id', $requestData['skill_id'])
            //     ->with('skills')
            //     ->get();
            $skill = Skill::where('id', $requestData['skill_id'])->with('developers')->get();
            // $developer = Developer::where('id', $skill->developers());
            $developers = $skill[0]->developers;
            $developers_id = [];

            for ($i = 0; $i < count($developers); $i++) {
                $developers_id[] = $developers[$i]->id;
            }
            $developers = Developer::whereIn('id', $developers_id)->with('user')->get();


            if (count($developers) == 0) {
                return response()->json([
                    'success' => false,
                    'error' => 'Nessun developer appartenente a questa specializzazione',
                ]);
            }
        } else {
            $developers = Developer::with('ratings', 'skills', 'user')->get();
        }
        $skills = Skill::all();
        $users = User::all();


        return response()->json([
            'success' => true,
            'results' => $developers,
            'allSkills' => $skills,
            'allUsers' => $users,
        ]);
    }
}
