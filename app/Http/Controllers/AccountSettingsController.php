<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountSettingsController extends Controller
{
    public function accountSettings()
    {
        $user = auth()->user();
        return view('static.accSettings', compact('user'));
    }
    public function showProfile()
    {
        $user = auth()->user();
        return view('profiles.profileInformation', compact('user'));
    }
    public function showPassword()
    {
        $user = auth()->user();
        return view('profiles.changePassword', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $user->email = $request->input('email');

        if ($user->profile) {
            $profile = $user->profile;
            $profile->first_name = $request->input('first_name');
            $profile->last_name = $request->input('last_name');
            $profile->phone_number = $request->input('phone_number');
            $profile->address = $request->input('address');
            $profile->save();
        } else {

            $profileData = [
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'phone_number' => $request->input('phone_number'),
                'address' => $request->input('address'),
            ];
            $user->profile->create($profileData);
        }
        return redirect()->back()->with('message', 'Profile information updated successfully.');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'confirmed'],
        ]);
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {

            return redirect()->back()->withErrors(['current_password' => 'The provided password does not match our records.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('message', 'Password changed successfully.');
    }
}
