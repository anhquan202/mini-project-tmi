<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    use HasUuids;
    protected $table = 'users';
    protected $primaryKey = 'u_id';
    public $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'u_id',
        'status_id',
        'first_name',
        'last_name',
        'address',
        'gender'
    ];


    protected static function booted()
    {
        static::creating(function ($user) {
            $user->u_id = $user->u_id ?? Str::uuid()->toString();
        });
    }
    public function getFullName()
    {
        return ucfirst($this->attributes['first_name'] ?? '') . ' ' . ucfirst($this->attributes['last_name'] ?? '');
    }

    //relationship
    public function status()
    {
        return $this->hasOne(Status::class, 'status_id', 'id');
    }
}
