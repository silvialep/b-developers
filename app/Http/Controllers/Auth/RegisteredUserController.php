<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Developer;
use App\Models\Skill;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $skills = Skill::all();
        return view('auth.register', compact('skills'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'last_name' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:50'],
            'skills' => ['required'],
        ],
        [
            'name.required' => 'Inserisci il nome',
            'name.max' => 'Il nome non deve superare i 255 caratteri',
            'email.required' => 'L\'email è richiesta',
            'email.email' => 'L\'email dev\'essere nel formato email',
            'email.max' => 'L\'email non deve superare i 255 caratteri',
            'email.unique' => 'Questo utente è già registrato',
            'password.required' => 'Inserisci una password',
            'last_name.required' => 'Inserisci il cognome',
            'last_name.max' => 'Il cognome non deve superare i :max caratteri',
            'address.required' => 'Inserisci l\'indirizzo',
            'address.max' => 'L\'indirizzo non deve superare i :max caratteri',
            'skills.required' => 'Inserisci almeno una specializzazione',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //___________________

        $completeName = $request->name . ' ' . $request->last_name;
        $formData = $request->all();

        $developer = Developer::create([
            'user_id' => $user->id,
            'last_name' => $request->last_name,
            'slug' => Str::slug($completeName, '-'),
            'address' => $request->address,
        ]);

        if (array_key_exists('skills', $formData)) {
            $developer->skills()->attach($formData['skills']);
        }



        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
