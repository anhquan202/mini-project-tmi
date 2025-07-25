<?php

namespace App\Console\Commands;

use App\Models\User;
use App\UserStatusEnum;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RevertStatusUserSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:revert-status-user-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notActiveUsers = User::notActiveStatus()->get();

        Log::info('Total users found: ' . $notActiveUsers->count());

        $notActiveUsers->each(function ($user) {
            if ($user->status_expires_at && $user->status_expires_at < now()) {
                $user->updateQuietly([
                    'status_id' => UserStatusEnum::ACTIVE->value,
                    'status_expires_at' => null
                ]);
                Log::info($user);
            }
        });
    }
}
