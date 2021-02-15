<?php

namespace App\Http\Controllers\Api\V1\Wink\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Wink\Auth\ForgetPasswordRequest;
use App\Jobs\Api\V1\Wink\Auth\ForgetPasswordJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function reset(ForgetPasswordRequest $request)
    {
        dispatch(new ForgetPasswordJob($request->email));
        return response()->noContent();
    }
}
