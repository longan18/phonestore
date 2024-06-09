<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Session;

class ClearSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-sessions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear all sessions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \session()->flush();
        $this->info('Sessions cleared successfully.');
    }
}
