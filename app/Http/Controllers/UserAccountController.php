<?php

namespace App\Http\Controllers;

use App\Exceptions\FailedVerifyResetPasswordCodeException;
use App\Exceptions\NotFoundUserException;
use App\Helpers\JsonResponseFormat;
use App\Helpers\PaginationHelper;
use App\Helpers\PaginationResponse;
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

            $username = $response['username'];
            $resetCode = $response['resetCode'];

            $this->iAuthService->resetPassword($username, $resetCode);

            return JsonResponseFormat::successResponse(200, 'Đổi mật khẩu thành công', []);
        } catch (NotFoundUserException | FailedVerifyResetPasswordCodeException $e) {
            return JsonResponseFormat::errorResponse(400, '', $e->getMessage());
        } catch (\Throwable $th) {
            return JsonResponseFormat::errorResponse(400, 'Lỗi hệ thống', $th->getMessage());
        }
    }

    public function showUsersHasAccount()
    {
        try {
            $data = UserAccount::with('user.status')->paginate(3);
            $page = (int) request()->query('page', 1);

            if ($page > $data->lastPage()) {
                return JsonResponseFormat::successResponse(
                    404,
                    'Danh sách rỗng do vượt quá page tối đa',
                    ['users' => []]
                );
            }

            return JsonResponseFormat::successResponse(
                200,
                'Danh sách người dùng',
                [
                    'users' => UserAccountResource::collection($data),
                    'pagination' => PaginationHelper::make($data)
                ]
            );
        } catch (\Throwable $th) {
            return JsonResponseFormat::errorResponse(500, 'Lỗi hệ thống', $th->getMessage());
        }
    }
}
