<?php

namespace App\Console\Commands;

use App\Models\PhoneBookUser;
use Illuminate\Console\Command;

class InActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:phonebook-users';

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
        $this->info('Expiring phone book users...');
        $this->expiredDate();
        $this->info('Phone book users expired successfully.');
    }
}
