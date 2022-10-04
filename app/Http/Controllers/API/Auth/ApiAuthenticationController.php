<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthenticationController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request) 
    {

        $this->guard();

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        //auth()->guard('api')->attempt($credentials)

        Auth::shouldUse('api');
        
        if(!Auth::attempt($data))
        {
            return response([
                'success' =>false,
                'message' => 'Invalid Credentials.'
            ], 403);
        }
        return response([
            'user' => auth()->user(),
            'token'=> auth()->user()->createToken('secret')->plainTextToken,
            'success' => true
        ], 200);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Logout Success'
        ], 200);
    }

    public function user()
    {
        return response([
            'user' => auth()->user()
        ], 200);
    }

    private function guard()
    {
        return Auth::guard('api');
    }
}
