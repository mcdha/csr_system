<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\PasswordResetToken;

class OtpVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $uuid)
    {
        $password_reset_token = PasswordResetToken::where('uuid', $uuid)
            ->where('is_activated', false)
            ->first();

        if(!$password_reset_token){
            return redirect(RouteServiceProvider::HOME);
        }

        return view("auth.otp_verification", compact("password_reset_token", "uuid"));
    }

    public function verify(Request $request){
        $password_reset_token = PasswordResetToken::where("uuid", $request->uuid)->first();
        $five_min_ago = $password_reset_token->updated_at->diffInMinutes(Carbon::now()) > 5;

        if($password_reset_token->token == $request->token && $five_min_ago){
            return redirect()->back()->with("error","Token has expired.");
        }

        if($password_reset_token->token == $request->token){

            $password_reset_token->update([
                'is_activated' => true
            ]);

            return redirect()->route('password_reset.index', ['uuid' => $password_reset_token->uuid]);
        }
        else{
            return redirect()->back()->with('error','Invalid OTP token');
        }
    }
}
