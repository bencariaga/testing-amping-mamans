<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('authentication.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'contact_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $pn = preg_replace('/^\+639/', '09', $data['contact_number']);
        $user = User::where('phone_number', $pn)->first();

        if (!$user || !Hash::check($data['password'], $user->hashed_password)) {
            return back()->withErrors([
                'contact_number' => 'Invalid credentials.',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('administrator.dashboard');
    }

    public function showSignup()
    {
        return view('authentication.signup');
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'given_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'surname' => 'required|string|max:255',
            'role' => 'required|in:Administrator,Encoder,GL Operator,SMS Operator',
            'phone_number' => 'required|string|unique:users,phone_number',
            'password' => 'required|string|confirmed',
            'profile_picture' => 'nullable|image|max:8192',
        ]);

        $pn = preg_replace('/^\+639/', '09', $data['phone_number']);
        $countThisYear = User::whereYear('time_registered', Carbon::now()->year)->count();
        $uid = 'USER-' . Carbon::now()->year . '-' . str_pad($countThisYear + 1, 3, '0', STR_PAD_LEFT);

        $path = $request->hasFile('profile_picture')
            ? $request->file('profile_picture')->store('profile_pictures', 'public')
            : null;

        $username = $data['surname'] . ', ' . $data['given_name']
            . ($data['middle_name'] ? ' ' . substr($data['middle_name'], 0, 1) . '.' : '');

        $user = User::create([
            'user_id' => $uid,
            'username' => $username,
            'given_name' => $data['given_name'],
            'middle_name' => $data['middle_name'] ?? null,
            'surname' => $data['surname'],
            'role' => $data['role'],
            'phone_number' => $pn,
            'plaintext_password' => $data['password'],
            'hashed_password' => Hash::make($data['password']),
            'profile_picture' => $path,
            'time_registered' => now(),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('administrator.dashboard');
    }

    public function showChangePassword()
    {
        return view('authentication.change-password');
    }

    public function resetPassword(Request $request)
    {
        $data = $request->validate([
            'contact_number' => 'required|string|exists:users,phone_number',
            'new_password' => 'required|string|confirmed',
        ]);

        $pn = preg_replace('/^\+639/', '09', $data['contact_number']);
        $user = User::where('phone_number', $pn)->first();

        $user->plaintext_password = $data['new_password'];
        $user->hashed_password = Hash::make($data['new_password']);
        $user->save();

        return redirect()->route('login')->with('success', 'Password updated successfully. Please log in.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}