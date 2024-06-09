<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;

class GetSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-sessions {session}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get session';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sessionArgument = $this->argument('session');
        $this->info('Get sessions successfully.');
        if (Session::has($sessionArgument)) {
            $value = Session::get($sessionArgument);
            $this->info("Value for '$sessionArgument': $value");
            return $value;
        } else {
            $this->error("Session key '$sessionArgument' not found.");
        }
    }
}
