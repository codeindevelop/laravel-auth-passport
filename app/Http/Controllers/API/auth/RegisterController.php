<?php

namespace App\Http\Controllers\API\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{

    public function register(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // If validator has ben faild
        if ($validate->fails()) {
            return response()->json([
                'message' => $validate->errors()->first()
            ], 400);
            // If validator is ok
        } else {

            $user = new User([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'activation_token' => Str::random(60),
                'register_ip' => $request->ip(),
            ]);

            $user->save();

            return response()->json([
                'message' => 'user has ben register successful!'
            ], 201);
        }
    }
}
