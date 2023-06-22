<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $this->validateForm($request);

        // leggo tutti i dati del form presenti nella request e mi creo un oggetto
        $formData = $request->all();

        // creo un nuovo record del modello Message
        $newMessage = new Message();

        // popolo i campi della tabella
        $newMessage->fill($formData);
        // slug
        $newMessage->slug = Str::slug($formData['name'], '-');
        // read
        $newMessage->read = 0;

        // salvo il record
        $newMessage->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
                'name' => 'required|max:255|min:5',
                'subject' => 'required',
                'email' => 'required',
                'content' => 'required',
                'meeting_date' => 'nullable',
            ],
            [
                'name.required' => 'Devi inserire il nome',
                'name.max' => 'Il nome non può superare i :max caratteri',
                'name.min' => 'Il nome deve avere almeno :min caratteri',
                'subject.required' => 'Devi inserire un oggetto',
                'email.required' => 'Devi inserire una mail',
                'content.required' => 'Devi inserire un contenuto',
                'meeting_date.required' => 'Devi inserire una data',
            ]
        )->validate();
        return $validator;
    }
}
