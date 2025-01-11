<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Mail\VerifyCodeEmail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
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
            // return redirect()->intended('/dashboard-pengaju');
            // Mengarahkan ke route pengecekan pengaju
            return redirect()->route('check.pengaju');
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
    public function sendVerificationCode(Request $request)
    {
        // Validasi input email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Generate kode verifikasi
        $verificationCode = rand(100000, 999999);

        // Simpan kode verifikasi dalam cache dengan waktu kedaluwarsa 10 menit
        Cache::put('verification_code_' . $request->email, $verificationCode, now()->addMinutes(10));

        // Data email untuk dikirimkan
        $data_email = [
            'subject' => 'Your Verification Code',
            'sender_name' => 'proposalkupolban@gmail.com',
            'verification_code' => $verificationCode,
        ];

        // Kirim email ke pengguna
        Mail::to($request->email)->send(new VerifyCodeEmail($data_email));

        return response()->json(['message' => 'Verification code sent successfully.']);
    }

    public function forgotPassword(Request $request)
    {
        // Validasi input email dan kode autentikasi
        $request->validate([
            'email' => 'required|email',
            'auth_code' => 'required|numeric',
        ]);
        Log::info('Input request: ' . json_encode($request->all()));

        $email = $request->input('email');
        $authCode = $request->input('auth_code');

        // Ambil kode verifikasi dari cache
        $cachedCode = Cache::get('verification_code_' . $email);


        if (!$cachedCode) {
            return response()->json(['message' => 'Verification code expired or not found.'], 400);
        }

        if ($authCode != $cachedCode) {
            return response()->json(['message' => 'Invalid verification code.'], 400);
        }

        // Hapus kode dari cache setelah diverifikasi
        Cache::forget('verification_code_' . $email);

        // Simpan email ke dalam sesi
        session(['email' => $email]);

        return response()->json(['message' => 'Verified!'], 200);
    }

    public function resetPassword(Request $request)
    {
        // Validasi input password
        $request->validate([
            'password' => 'required|min:8',
        ]);

        // // Ambil pengguna berdasarkan email (dalam sesi atau dari data sebelumnya)
        $email = session('email'); // Pastikan email tersimpan di sesi sebelumnya

        if (!$email) {
            return response()->json(['message' => 'Session expired. Please restart the process.'], 400);
        }

        // Perbarui password pengguna
        $user = Mahasiswa::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        // Log::info('Password baru tersimpan: ' . $request->password);
        // Log::info('Password baru tersimpan: ' . $user->password);

        // Hapus sesi email reset
        session()->forget('email');

        return redirect()->route('login.mahasiswa')->with('success', 'Password updated successfully!');
    }

    public function resetPasswordDosen(Request $request)
    {
        // Validasi input password
        $request->validate([
            'password' => 'required|min:8',
        ]);

        // // Ambil pengguna berdasarkan email (dalam sesi atau dari data sebelumnya)
        $email = session('email'); // Pastikan email tersimpan di sesi sebelumnya

        if (!$email) {
            return response()->json(['message' => 'Session expired. Please restart the process.'], 400);
        }

        // Perbarui password pengguna
        $user = Dosen::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();
        // Log::info('Password baru tersimpan: ' . $request->password);
        // Log::info('Password baru tersimpan: ' . $user->password);

        // Hapus sesi email reset
        session()->forget('email');

        return redirect()->route('login.dosen')->with('success', 'Password updated successfully!');
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