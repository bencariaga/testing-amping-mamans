<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = User::findOrFail(Auth::id());

        return view('administrator.dashboard.user-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        if ($request->input('action') === 'change_password') {
            $request->validate([
                'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                    if (! Hash::check($value, $user->hashed_password)) {
                        $fail('The current password does not match our records.');
                    }
                }],
                'new_password' => 'required|string|min:8|confirmed',
            ]);

            $user->plaintext_password = $request->new_password;
            $user->hashed_password    = Hash::make($request->new_password);
            $user->save();

            return back()->with('success', 'Password changed successfully.');
        }

        $request->validate([
            'given_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'surname'         => 'required|string|max:255',
            'phone_number'    => ['required', 'string', Rule::unique('users')->ignore($user->user_id, 'user_id')],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,jfif|max:8192',
        ], [], [
            'phone_number' => 'phone number',
        ]);

        $dataToUpdate = [
            'given_name'     => $request->given_name,
            'middle_name'    => $request->middle_name,
            'surname'        => $request->surname,
            'phone_number'   => $request->phone_number,
            'username'       => $request->surname
                               . ', '
                               . $request->given_name
                               . ($request->middle_name
                                  ? ' ' . substr($request->middle_name, 0, 1) . '.'
                                  : ''),
        ];

        if ($request->input('remove_profile_picture_flag') === '1' && $user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $dataToUpdate['profile_picture'] = null;
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $dataToUpdate['profile_picture'] = $request
                                            ->file('profile_picture')
                                            ->store('profile_pictures', 'public');
        }

        $user->update($dataToUpdate);

        return redirect()
               ->route('user.profile.show')
               ->with('success', 'Profile updated successfully');
    }

    public function destroy(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'password_confirmation_delete' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (! Hash::check($value, $user->hashed_password)) {
                    $fail('The provided password does not match for account deletion.');
                }
            }],
        ]);

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
               ->route('home')
               ->with('success', 'Your account has been deleted successfully.');
    }
}