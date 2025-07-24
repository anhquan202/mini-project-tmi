<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\IAuthService;
use Illuminate\Http\Request;

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
    public function test()
    {
        echo 1;
    }
}
