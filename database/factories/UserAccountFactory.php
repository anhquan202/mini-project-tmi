<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAccount>
 */
class UserAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserAccount::class;
    public function definition(): array
    {
        return [
            'u_id' => User::inRandomOrder()->value('u_id'),
            'username' => fake()->userName(),
            'password' => bcrypt(fake()->password)
        ];
    }
}
