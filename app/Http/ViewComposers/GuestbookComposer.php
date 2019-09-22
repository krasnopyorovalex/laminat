<?php

namespace App\Http\ViewComposers;

use App\Domain\Guestbook\Queries\GetAllGuestbookQuery;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Bus\DispatchesJobs;

class GuestbookComposer
{
    use DispatchesJobs;

    /**
     * @param View $view
     */
    public function compose(View $view)
    {
        $guestbook = $this->dispatch(new GetAllGuestbookQuery(true, 10));

        $view->with('guestbook', $guestbook);
    }
}
