<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Resources\UserAccountResource;
use App\Jobs\SendPasswordResetCodeMail;
use App\Mail\ResetPasswordMail;
use App\Models\UserAccount;
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

    public function showUsersHasAccount()
    {
        try {
            $data = UserAccount::with('user.status')->get();

            return response()->json([
                'success' => true,
                'message' => 'Danh sách người dùng',
                'data' => UserAccountResource::collection($data)
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi hệ thống',
                'errors' => $th->getMessage()
            ]);
        }
    }
}
