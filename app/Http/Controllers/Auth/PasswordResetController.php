<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\PasswordResetTokenMail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordReset\SaveNewPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Providers\RouteServiceProvider;
use App\Models\PasswordResetToken;

class PasswordResetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $uuid)
    {
        $password_reset_token = PasswordResetToken::where("uuid", $uuid)->first();

        if(!$password_reset_token || !$password_reset_token->is_activated) {
            return redirect(RouteServiceProvider::HOME);
        }

        return view("auth.password_reset", compact("uuid"));
    }

    public function saveNewPassword(SaveNewPasswordRequest $request)
    {
        $password_reset_token = PasswordResetToken::where('uuid', $request->uuid)->first();
        $user = User::where('email', $password_reset_token->email)->first();

        $user->update([
            'password' => hash('sha256', $request->new_password)
        ]);

        Auth::loginUsingId($user->id);
        $password_reset_token->delete();
        return redirect()->route('dashboard.index')->with('success','Your new password has been saved!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $password_reset_token = PasswordResetToken::updateOrCreate(
            ['email' => $request->email],
            [
                'token' => random_int(100000, 999999),
                'is_activated' => false
            ]
        );

        $user = User::where('email', $password_reset_token->email)->first();

        if(!$user){
            return redirect()->route('login.index')->with(['error' => 'Invalid input email.']);
        }

        Mail::to($user->email)->queue(new PasswordResetTokenMail($user, $password_reset_token));
        return redirect()->route('otp_verification.index', ['uuid' => $password_reset_token->uuid]);
    }

    public function resend($uuid){
        $password_reset_token = PasswordResetToken::where('uuid', $uuid)->first();

        $password_reset_token->update([
            'token' => random_int(100000, 999999)
        ]);

        $user = User::where('email', $password_reset_token->email)->first();
        Mail::to($user->email)->queue(new PasswordResetTokenMail($user, $password_reset_token));

        return redirect()->back()->with('success','OTP has been resent successfully!');
    }
}
