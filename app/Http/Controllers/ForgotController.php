<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotController extends Controller
{
    public function showForgot()
    {
        return view('auth.forgot');
    }

    public function sendReset(Request $request)
    {
        $request->validate([
            "email" => "required|email"
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with("success", __($status))
            : back()->withErrors(["email" => __($status)]);
    }

    public function showReset($token)
    {
        return view('auth.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            "token" => "required",
            "email" => "required|email",
            "password" => "required|min:6|confirmed",
        ]);

        $status = Password::reset(
            $request->only("email", "password", "password_confirmation", "token"),
            function ($user) use ($request) {
                $user->forceFill([
                    "password" => bcrypt($request->password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route("login")->with("success", __($status))
            : back()->withErrors(["email" => [__($status)]]);
    }
}
