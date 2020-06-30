<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (!$token = Auth::attempt($credentials)) throw new AuthenticationException();

        return $this->respondWithToken($token);
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required'
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return $this->login($request);
    }

    public function updateUserDetails(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)]
        ]);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'Updated Successfully',
            'user' => $user
        ]);
    }

    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required'
        ]);
        if (Hash::check($request->old_password, Auth::user()->password)) {
            Auth::user()->update(['password' => Hash::make($request->password)]);
            return response()->json([
                'success' => true,
                'message' => 'Updated Successfully'
            ]);
        }
        return response()->json([
            'status' => 401,
            'message' => 'Wrong Password'
        ], 401);
    }


    public function me()
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }


    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => Auth::user()
        ]);
    }
} // END OF CONTROLLER
