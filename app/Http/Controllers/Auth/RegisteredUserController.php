<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ValidateEmail;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    
    public function signUpStep1Create(): View
    {
        return view('auth.sign-up-step1');
    }

    public function signUpStep1Store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $code = \str()->random(4);

        // Send the email
        Mail::to($request->email)->send(new ValidateEmail($code));

        // Configure session step and code
        $request->session()->put('step', 'step2');
        $request->session()->put('code', $code);

        // redirected to step 2
        return redirect(route('sign-up-step2', absolute: false));
    }

    public function signUpStep2Create(Request $request): View
    {
        $step = $request->session()->pull('step');
        //if ($step !== 'step2'){
        //    return view('auth.sign-up-step1');
        //}
        return view('auth.sign-up-step2');
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
