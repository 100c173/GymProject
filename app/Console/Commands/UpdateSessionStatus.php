<?php

namespace App\Console\Commands;

use App\Models\Session;
use Illuminate\Console\Command;

class UpdateSessionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessions:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Update automaticly the session status';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        Session::whereIn('status', ['inactive', 'active'])
            ->whereHas('time', function ($query) {
                $query->where('day', now()->toDateString());
            })
            ->chunk(10, function ($sessions) {

                foreach ($sessions as $session) {

                    if ($session->time->end_time <= now()) {

                        $session->status = 'completed';
                    } elseif ($session->time->start_time <= now() && $session->time->end_time > now()) {

                        $session->status = 'active';
                    }

                    $session->save();
                }
            });
    }
}
