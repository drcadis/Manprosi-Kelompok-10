<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Mime\Message;

class AuthController extends Controller
{
    public function showRegistration()
    {
        return view('auth.register');
    }
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
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

        $token = $user->createToken('auth_token')->plainTextToken;

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully',
                'token' => $token,
                'user' => $user,
            ], 201);
        }
        return redirect()->route('login')->with('success', 'Email telah terdaftar');
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
            $token = $user->createToken('auth_token')->plainTextToken;

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'User logged in successfully',
                    'token' => $token,
                    'user' => $user,
                ], 200);
            }

            $request->session()->regenerate();
            return redirect()->intended('dashboard');
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
}
