<?php

namespace App\Domain\Guestbook\Commands;

use App\Domain\Guestbook\Queries\GetGuestbookByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Events\RedirectDetected;
use App\Guestbook;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateGuestbookCommand
 * @package App\Domain\Guestbook\Commands
 */
class UpdateGuestbookCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateGuestbookCommand constructor.
     * @param int $id
     * @param Request $request
     */
    public function __construct(int $id, Request $request)
    {
        $this->id = $id;
        $this->request = $request;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        $guestbook = $this->dispatch(new GetGuestbookByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($guestbook->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($guestbook->getOriginal('alias'), $urlNew));
        }

        if ($this->request->has('image')) {
            if ($guestbook->image) {
                $this->dispatch(new DeleteImageCommand($guestbook->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $guestbook->id, Guestbook::class));
        }

        return $guestbook->update($this->request->all());
    }

}