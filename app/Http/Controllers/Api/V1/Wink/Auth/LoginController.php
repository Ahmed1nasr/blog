<?php

namespace App\Http\Controllers\Api\V1\Wink\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Wink\Auth\LoginRequest;
use App\Http\Resources\Api\V1\Wink\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth()->guard('wink')->attempt($request->only(['email', 'password']))) {
            return (new LoginResource(["token" => auth()->guard('wink')->user()->createToken('mobile')->plainTextToken, 'type' => "Bearer"]));
        }

        throw ValidationException::withMessages(['email' => "email or password is wrong"]);
    }
}
