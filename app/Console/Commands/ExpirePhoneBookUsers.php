<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ExpirePhoneBookUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $userController = new UserController();
        $userController->expiredDate();
        $this->info('Users have been expired.');
    }
}
