<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Jobs\SendPasswordResetCodeMail;
use App\Mail\ResetPasswordMail;
use App\Services\Auth\IAuthService;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserAccountController extends Controller
{
    public function __construct(protected IAuthService $iAuthService)
    {
    }
    public function login(LoginRequest $loginRequest)
    {
        try {

            $credentials = $loginRequest->validated();
            $result = $this->iAuthService->loginUsingSanctum($credentials['username'], $credentials['password']);
            if (!$result['status']) {
                return response()->json(['error' => $result['message']], 400);
            }
            return response()->json(['data' => $result], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);

        }
    }
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest)
    {
        try {
            $response = $resetPasswordRequest->validated();

            $resetPassword = $this->iAuthService->resetPassword($response['username'], $response['resetCode']);

            if (!$resetPassword['status']) {
                return response()->json($resetPassword['error'], 400);
            }

            return response()->json($resetPassword['message']);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);

        }
    }
}
