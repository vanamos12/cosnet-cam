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
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;

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
        $request->session()->put('email', $request->email);

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

    public function signUpStep2Store(Request $request): RedirectResponse
    {
        $validator = Validator::make([], []);
        // Verify the code
        $codeReceived = $request->code;
        $code = $request->session()->pull('code');

        if ($code !== $codeReceived){
            $validator->errors()->add('code', 'The code received is not correct');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Not a cosnet Member
        if ($request->cosnetmember == 'notcosnetmember'){
            return redirect(route('register', absolute: false));
        }else{
            // Validate and get the data of the membershipid
            $membershipid = trim($request->membershipid);
            $token = env('COSNET_TOKEN');

            $response = Http::withoutVerifying()
            ->withUrlParameters([
                'endpoint' => 'https://mycosnet.org/main/get_membership_details.php',
                'token' => $token,
                'membershipid' => $membershipid,
            ])
            ->get("{+endpoint}?token={token}&membershipid={membershipid}");
            $json = $response->json();

            if ($json['status'] !== 'success'){
                $validator->errors()->add('membershipid', $json['message']);
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                // success
                dd($json);
            }
        }


        // redirected to register
        return redirect(route('sign-up-step2', absolute: false));
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
