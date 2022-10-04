<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users\Staff;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
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

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {

        if (! $token = JWTAuth::attempt($this->credentials($request))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $staff = auth()->user();

        return $this->respondWithToken($token,$staff);
    }

    protected function credentials(Request $request)
    {
        return [
            'uid' => $request->username,
            'password' => $request->password,
            'fallback' => [
                'username' => $request->username,
                'password' => $request->password,
            ],
        ];
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function user()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh(),auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param  Staff $staff
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token,$staff)
    {
        return response()->json([
            'access_token' => $token,
            'staff'=> $staff,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }

    private function guard()
    {
        return Auth::guard('api');
    }
}
