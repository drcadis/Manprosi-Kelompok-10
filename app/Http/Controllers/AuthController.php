<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Mime\Message;

class AuthController extends Controller
{
    public function showDashboard()
    {
        return view('welcome');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $validator->validated()['name'],
            'email' => $validator->validated()['email'],
            'password' => Hash::make($validator->validated()['password']),
            'role' => 'user',
            
        ]);

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'user' => $user,
            ], 201);
        }
        return redirect()->route('home')->with('register_success', 'Akun Berhasil Dibuat, Silahkan Login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($validator->validated(), $remember)) {
            $user = User::where('email', $validator->validated()['email'])->first();

            return redirect('/')->with('login_success', 'Berhasil login');

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User logged in successfully',
                    'user' => $user,
                ], 200);
            }

            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        if ($request->expectsJson()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password salah',
            ], 401);
        }
        return back()->withErrors([
            'email' => 'Email atau password salah',
            'password' => 'Email atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        if ($request->expectsJson()) {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Anda Berhasil logout',
            ], 200);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda Berhasil logout');
    }

    public function carousel()
    {
        $items = Items::where('status_barang', 'Belum Ditemukan' && 'tipe_laporan', 'Kehilangan Pemilik')
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('items'));
    }
}
