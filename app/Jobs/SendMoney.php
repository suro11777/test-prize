<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMoney implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $money;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($money)
    {
        $this->money = $money;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = auth()->user();
        //  . . . . .
        // . . . .
        //send money api bank, $user->account_number_bank
        //.....
        //.....
        $user->money = 0;
        $user->save();
    }
}
