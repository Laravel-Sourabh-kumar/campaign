<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle()
{
    foreach ($this->contacts as $contact) {
        Mail::to($contact->email)->send(new CampaignEmail($this->campaign, $contact));
    }
    // Notify user after the campaign is processed
    $this->campaign->user->notify(new CampaignCompleted($this->campaign));
}

}
