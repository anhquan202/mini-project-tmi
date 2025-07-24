<?php
namespace App\Services\Auth;

use Illuminate\Support\Facades\Log;
use App\Models\UserAccount;
use Illuminate\Support\Facades\Hash;
use App\Jobs\SendPasswordResetCodeMail;

class AuthService implements IAuthService
{
    public function loginUsingSanctum(?string $username, ?string $password)
    {
        $userAccount = UserAccount::exist($username)->first();
        if (empty($userAccount)) {
            return [
                'status' => false,
                'message' => 'Không tìm thấy user',
            ];
        }

        if (!Hash::check($password, $userAccount->password)) {
            return [
                'status' => false,
                'message' => 'Thông tin đăng nhập không chính xác',
            ];
        }
        $user = $userAccount->user;

        $token = $userAccount->createToken('auth_token')->plainTextToken;

        return [
            'status' => true,
            'token' => $token,
            'user' => $user,
        ];

    }

    public function resetPassword(string $username, string $resetCode)
    {
        try {
            $user = UserAccount::exist($username)->first();
            if (empty($user)) {
                return [
                    'status' => false,
                    'error' => 'Không tìm thấy người dùng này'
                ];
            }

            dd(session('generatedCode'));
            $verifyCode = session('generatedCode') == $resetCode;
            if (!$verifyCode) {
                return [
                    'status' => false,
                    'error' => 'Mã xác thực không khớp'
                ];
            }

            $newPassword = '12345';
            $user->update([
                'password' => Hash::make($newPassword)
            ]);

            return [
                'status' => true,
                'message' => 'Đổi mật khẩu thành công'
            ];

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return false;
        }
    }
}