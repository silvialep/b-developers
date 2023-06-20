<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Rating;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DeveloperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developer::FindOrFail($id);
        $ratingsAvg = Rating::where('developer_id', $id)->avg('rating');
        $ratingsNumber = Rating::where('developer_id', $id)->count();

        // memorizzo lo user loggato
        $user = Auth::user();
        // memorizzo il profilo riferito allo user loggato
        $devLogged = $user->developer;

        // se l'id passato dal form è diverso da quello del profilo loggato
        if ($id != $user->developer->id) {
            // ritorna alla show del profilo loggato
            // return redirect()->route('admin.profile.show', $devLogged);
            $this->errors();
            
        } else {
            // mi porta alla rotta show con il developer passato dal form
            
            return view('admin.profile.show', compact('developer', 'ratingsAvg', 'ratingsNumber'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $developer = Developer::FindOrFail($id);

        // skills
        $skills = Skill::all();

        // memorizzo lo user loggato
        $user = Auth::user();
        // memorizzo il profilo riferito allo user loggato
        $devLogged = $user->developer;

        // se l'id passato dal form è diverso da quello del profilo loggato
        if ($id != $user->developer->id) {
            // ritorna alla show del profilo loggato
            return redirect()->route('admin.profile.edit', $devLogged);
        } else {
            return view('admin.profile.edit', compact('developer', 'skills'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateForm($request);
        // qui validiamo i dati
        $formData = $request->all();

        $developer = Developer::FindOrFail($id);

        // qui controllo se ho immagine di profilo e cv
        if ($request->hasFile('picture')) {
            if ($developer->picture) {
                Storage::delete($developer->picture);
            }

            // mi salvo il percorso nella cartella developer_pictures
            $path = Storage::put('developer_pictures', $request->picture);

            // memorizzo il path dell'immagine nella tabella
            $formData['picture'] = $path;
        }

        if ($request->hasFile('cv')) {
            if ($developer->cv) {
                Storage::delete($developer->cv);
            }

            // mi salvo il percorso nella cartella developer_cvs
            $path = Storage::put('developer_cvs', $request->cv);

            // memorizzo il path dell'immagine nella tabella
            $formData['cv'] = $path;
        }

        // $user_id = $developer->user_id;
        // $user = User::where('id', $user_id)->first();

        // $fullName = $user->name . ' ' . $formData['last_name'];

        // $formData['slug'] = Str::slug($fullName, '-');

        $developer->update($formData);

        // controllo modifiche skills
        if (array_key_exists('skills', $formData)) {
            $developer->skills()->sync($formData['skills']);
        } else {
            $developer->skills()->detach();
        }

        return redirect()->route('admin.profile.show', $developer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function validateForm($request)
    {
        $formData = $request->all();
        $validator = Validator::make(
            $formData,
            [
                'address' => 'required|max:50',
                'cv' => 'nullable|image|max:4096',
                'picture' => 'nullable|image|max:4096',
                'phone' => 'nullable|min:10|max:13',
                'services' => 'nullable|min:20',
                'role' => 'nullable|max:100',
                'skills' => 'required',
            ],
            [
                'address.required' => 'È necessario inserire l\'indirizzo',
                'address.max' => 'Non puoi superare i :max caratteri',
                'cv.image' => 'Inserisci un file di formato immagine',
                'cv.max' => 'L\'immagine non può superare i 4 MB',
                'picture.image' => 'Inserisci un file di formato immagine',
                'picture.max' => 'L\'immagine non può superare i 4 MB',
                'phone.min' => 'Inserisci almeno :min cifre',
                'phone.max' => 'Non puoi inserire più di :max cifre',
                'services.min' => 'Inserisci almeno :min caratteri',
                'role.max' => 'Non puoi inserire più di :max caratteri',
                'skills.required' => 'Inserisci almeno una specializzazione',
            ]
        )->validate();
        return $validator;
    }

    public function errors(){
        return redirect()->route('error');
        // return view('errors.notfound');
        
    }


}
