<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = UserAccount::class;
    public function definition()
    {
        return [
            'status_id' => Status::inRandomOrder()->value('id'),
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'address' => fake()->address,
            'gender' => fake()->randomElement(['nam', 'nữ', 'khác'])
        ];
    }
}
