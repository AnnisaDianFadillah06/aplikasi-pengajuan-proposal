<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function index()
    {
        if (Auth::check()) {
            return redirect()->route('beasiswa.index');
        }
        return view('proposal_kegiatan.Auth.login');
    }

    public function showLoginFormMahasiswa()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard-pengaju');
        }
        return view('proposal_kegiatan.Auth.login_mahasiswa'); // View untuk login mahasiswa
    }

    public function showLoginFormDosen()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard-reviewer');
        }
        return view('proposal_kegiatan.Auth.login_dosen'); // View untuk login dosen
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'regex:/^[a-zA-Z0-9._%+-]+@polban\.ac\.id$/',
            ],
            'password' => 'required|min:6',
        ], [
            'email.regex' => 'Gunakan email polban!',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-pengaju');
        }

        return back()->withErrors(['email' => 'Email or password is incorrect.'])->onlyInput('email');
    }

    public function loginMahasiswa(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('mahasiswa')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-pengaju');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    public function loginDosen(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('dosen')->attempt($credentials)) {
            $request->session()->regenerate();
            // return redirect()->intended('/dashboard-reviewer');
            // Mengarahkan ke route pengecekan reviewer
            return redirect()->route('check.reviewer');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->onlyInput('email');
    }

    /**
     * Handle forgot password form submission.
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'auth_code' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email tidak ditemukan!'], 400);
        }

        if ($request->auth_code !== '123456') {
            return response()->json(['message' => 'Kode autentikasi salah!'], 400);
        }

        Session::put('auth_email', $request->email);
        return response()->json(['message' => 'Verified!'], 200);
    }

    /**
     * Handle reset password submission.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $email = Session::get('auth_email');
        if (!$email) {
            return response()->json(['message' => 'Unauthorized request. Please restart the process.'], 400);
        }

        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        Session::forget('auth_email');
        return response()->json(['message' => 'Password updated successfully!'], 200);
    }

    /**
     * Logout the user.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}