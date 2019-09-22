<?php

namespace App\Domain\Guestbook\Commands;

use App\Domain\Guestbook\Queries\GetGuestbookByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class DeleteGuestbookCommand
 * @package App\Domain\Guestbook\Commands
 */
class DeleteGuestbookCommand
{

    use DispatchesJobs;

    /**
     * @var int
     */
    private $id;

    /**
     * DeleteGuestbookCommand constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $guestbook = $this->dispatch(new GetGuestbookByIdQuery($this->id));

        if($guestbook->image) {
            $this->dispatch(new DeleteImageCommand($guestbook->image));
        }

        return $guestbook->delete();
    }

}