<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("auth.login");
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && hash_equals($user->password, hash('sha256', $request->password))) {
            Auth::loginUsingId($user->id, $request->remember ? true : false);
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('login.index')->with('error', 'Invalid email/password.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
