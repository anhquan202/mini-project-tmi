<?php

namespace App\Models;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class UserAccount extends Authenticatable
{
    use HasFactory;
    use HasApiTokens;
    protected $table = 'user_accounts';
    protected $primaryKey = 'user_account_id';
    public $keyType = 'int';
    public $incrementing = false;

    protected $fillable = [
        'user_account_id',
        'u_id',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];
    protected function password()
    {
        return CastsAttribute::make(
            set: fn($value) => bcrypt($value)
        );
    }

    //relationship
    public function user()
    {
        return $this->hasOne(User::class, 'u_id', 'u_id');
    }

    public function scopeExist($query, string $username)
    {
        return $query->where('username', '=', $username);
    }
}
