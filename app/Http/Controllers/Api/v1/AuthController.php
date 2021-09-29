<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiBaseController
{
    public function login(Request $request)
    {
        try {
            $login = $request->validate([
                'email' => 'required|string|',
                'password' => 'required|string',
            ]);
            if (!Auth::attempt($login)) {
                return $this->errorData("invalid login credentials", 500);
            }

            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            $user = Auth::user();
            if (isset($user->image)) {
                $user->image = asset('/storage/user/' . $user->id . '/' . $user->image);
            }
            $data = ['user' => $user, 'access_token' => $accessToken];
            return $this->successData("success", $data);
        } catch (\Exception $e) {
            return $this->errorData("server error".$e, 500);
        }
    }
}
