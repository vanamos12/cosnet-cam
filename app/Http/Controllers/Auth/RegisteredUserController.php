<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Utils\Membership;
use App\Http\Utils\Name;
use App\Mail\ValidateEmail;
use App\Models\ChangeName;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

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

        $code = strval(mt_rand(100000, 999999));

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
        $step = $request->session()->get('step');
        if ($step !== 'step2'){
            return redirect(route('sign-up-step1', absolute:false));
        }
        return view('auth.sign-up-step2');
    }

    public function signUpStep2Store(Request $request): RedirectResponse
    {
        $request->validate([
            'membershipid' => ['nullable', 'string', 'max:50'],
            'code' => ['required', 'numeric', 'max:999999', 'min:100000']
        ]);

        $validator = Validator::make([], []);

        $membershipid = trim($request->membershipid);
        $token = config('cosnet.token');

        // Verify the code
        $codeReceived = $request->code;
        $code = $request->session()->get('code');

        if ($code !== $codeReceived){
            $validator->errors()->add('code', 'The code received is not correct');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Not a cosnet Member
        if ($request->cosnetmember == 'notcosnetmember'){
            $request->session()->put("user", [
                "first_name" => "",
                "last_name" => "",
                "membershipid" => Membership::genTempMembershipId(),
                "status" => "not_cosnet_member"
            ]);
            $request->session()->put('step', 'step3');
            return redirect(route('register', absolute: false));
        }else{
            // Validate and get the data of the membershipid
            

            $response = Http::withoutVerifying()
            ->withUrlParameters([
                'endpoint' => 'https://mycosnet.org/main/get_membership_details.php',
                'token' => urlencode($token),
                'membershipid' => urlencode($membershipid),
            ])
            ->get("{+endpoint}?token={token}&membershipid={membershipid}");
            $json = $response->json();

            if ($json['status'] !== 'success'){
                $validator->errors()->add('membershipid', $json['message']);
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                // success
                $request->session()->put("user", [
                    "first_name" => $json["data"]["firstName"],
                    "last_name" => $json["data"]["lastName"],
                    "membershipid" => $membershipid,
                    "status" => "cosnet_member"
                ]);
                $request->session()->put('step', 'step3');
                return redirect(route('register', absolute: false));
            }
        }


        // redirected to register
        return redirect(route('sign-up-step2', absolute: false));
    }

    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $step = $request->session()->get('step');
        if ($step !== 'step3'){
            return redirect(route('sign-up-step1', absolute:false));
        }

        $email = request()->session()->get('email');
        $user = request()->session()->get('user');
        $fisrt_name = $user['first_name'];
        $last_name = $user['last_name'];
        $membershipid = $user['membershipid'];
        return view('auth.register', [
            "first_name" => $fisrt_name,
            "last_name" => $last_name,
            "membershipid" => $membershipid,
            "email" => $email
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'membershipid' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'state' => ['required', 'string', 'max:255'],
            'town' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function() use ($request) {
            $userSession = session('user');
            $email = session('email');
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'membershipid' => $userSession['membershipid'],
                'state' => $request->state,
                'town' => $request->town,
                'email' => $email,
                'password' => Hash::make($request->password),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);

            event(new Registered($user));

            Auth::login($user);

            // If the name has changed
            if ($userSession["status"] == 'cosnet_member'
                && 
                !Name::isSameName($userSession['first_name'], $userSession['last_name'], $request->first_name, $request->last_name)){
                
                ChangeName::create([
                    'first_name' => $userSession['first_name'],
                    'last_name' => $userSession['last_name'],
                    'change_name_able_id' => $user->id,
                    'change_name_able_type' => User::class
                ]);
            }

        });

        

        
        return redirect(route('dashboard', absolute: false));
    }
}
