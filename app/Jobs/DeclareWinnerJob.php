<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Winner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DeclareWinnerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     *
     * @return void
     */

     public function handle()
     {
         $topUser = User::orderByDesc('points')->first();
     
         if (!$topUser) {
             Log::info('No users found.');
             return;
         }
     
         Log::info('Top User: ' . $topUser->name . ' with ' . $topUser->points . ' points.');
     
         Winner::updateOrCreate(
             ['user_id' => $topUser->id], 
             ['points' => $topUser->points]
         );
     
         Log::info('Winner declared: ' . $topUser->name);
     }
     

}
