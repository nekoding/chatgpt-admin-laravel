<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:jwt', ['except' => ['login', 'signup']]);
    }

    /**
     * Handle login user from app
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $creds = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);

        if (!$token = $this->auth()->attempt($creds)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return new \App\Http\Resources\Auth\LoginResource($token, $this->auth());
    }

    /**
     * Handle register user from app
     *
     * @param Request $request
     * @return void
     */
    public function signup(Request $request)
    {
        $creds = $request->validate([
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|confirmed'
        ]);

        try {
            $creds['password'] = Hash::make($creds['password']);
            $user = \App\Models\User::create($creds);

            // send email confirmation link

            // generate login token
            $token = $this->auth()->login($user);

            return (new \App\Http\Resources\Auth\LoginResource($token, $this->auth()))->response()->setStatusCode(201);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 400);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $this->auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = $this->auth()->refresh();
        return new \App\Http\Resources\Auth\LoginResource($token, $this->auth());
    }

    /**
     * Setup Auth Guard
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard;
     */
    private function auth()
    {
        return Auth::guard('jwt');
    }
}
