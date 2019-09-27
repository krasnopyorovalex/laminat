<?php

namespace App\Listeners;

use App\Events\RedirectDetected;
use Illuminate\Foundation\Bus\DispatchesJobs;

class NewRedirectListener
{
    use DispatchesJobs;

    /**
     * Handle the event.
     *
     * @param  RedirectDetected  $event
     * @return void
     */
    public function handle(RedirectDetected $event): void
    {

    }
}
