<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;
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

    protected function password()
    {
        return CastsAttribute::make(
            set: fn($value) => bcrypt($value)
        );
    }

    //relationship
    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'u_id');
    }
}
