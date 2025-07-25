<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'status_name',
        'description'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
