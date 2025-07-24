<?php
namespace App\Services\Auth;
interface IAuthService
{
    public function loginUsingSanctum(?string $username, ?string $password);
}