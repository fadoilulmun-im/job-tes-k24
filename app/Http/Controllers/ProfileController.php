<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if(auth()->user()->role_id == config('env.role.member')){
            $request->validate([
                'phone' => ['required', 'numeric'],
                'date_of_birth' => ['required', 'date'],
                'gender' => ['required', 'in:male,female'],
                'ktp_number' => ['required', 'numeric', 'unique:members'],
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        DB::transaction(function () use($request) {
            $request->user()->save();
            if($request->hasFile('photo')){
                $imageName = time().'.'.$request->photo->getClientOriginalExtension();
                $request->photo->move(public_path('/uploads/member'), $imageName);
                $photo = 'member/'.$imageName;
            }

            $request->user->member()->create([
                'phone_number' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
                'ktp_number' => $request->ktp_number,
                'photo' => $photo ?? null,
            ]);
        });

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
