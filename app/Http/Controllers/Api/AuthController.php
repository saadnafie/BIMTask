<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $data = null;
        $valid = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if($valid->fails()){
            $error = $valid->errors();
            return $this->toJson(400,"Missing Some Request Data",$error);
        }else{
            $credentials = $request->only(['email', 'password']);

            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->toJson(402,"There is an error",null);
            }else{
                $user = Auth::user();
                $user->token = $token;
                $user->token_type = 'bearer';
                $data["user"] = $user;
                return $this->toJson(200,"Success",$data);
            }
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function toJson($code,$message,$data){
        $status['code'] = $code;
        $status['message'] = $message;
        $response['status'] = $status;
        if($data != null)
            $response['data'] = $data;
        return response()->json($response,200);
    }
}