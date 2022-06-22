<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);

        // If validator has ben error
        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->first()
            ]);
        }

        $cerdinentals = request(['email', 'password']);

        // If user dos not exist
        if (!Auth::attempt($cerdinentals)) {
            return response()->json([
                'message' => 'unauthorized'
            ], 401);
        }

        $user = Auth::user();

        // If user email has not verified return this message
        if (!$user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'Email has not verified'
            ], 401);
        }

        $tokenResult = $user->createToken('Login Token');
        $token = $tokenResult->token;

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),

        ], 200);
    }


    //Show user profile detaile
    public function profile()
    {
        $user = Auth::user();

        return response()->json([
            'user' => $user
        ], 200);
    }
}
