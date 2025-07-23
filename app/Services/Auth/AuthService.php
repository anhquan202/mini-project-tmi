<?php
namespace App\Services\Auth;

use App\Models\UserAccount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
}