<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Utils\Name;
use App\Models\ChangeName;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // view('profile.edit')
        return view('auth.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        DB::transaction(function() use ($request){

            $past_first_name = $request->user()->first_name;
            $past_last_name = $request->user()->last_name;

            $request->user()->fill($request->safe()->except(['email', 'membershipid']));

            $request->user()->save();

            // If the name has changed
            if (!Name::isSameName(
                    $past_first_name, 
                    $past_last_name, 
                    $request->user()->first_name, 
                    $request->user()->last_name)){
                
                ChangeName::create([
                    'first_name' => $past_first_name,
                    'last_name' => $past_last_name,
                    'change_name_able_id' => $request->user()->id,
                    'change_name_able_type' => User::class
                ]);
            }
        });
       



        return Redirect::route('profile.edit')->with('success', 'Profile updated Successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
