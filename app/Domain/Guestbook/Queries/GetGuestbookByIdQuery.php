<?php

namespace App\Domain\Guestbook\Queries;

use App\Guestbook;

/**
 * Class GetGuestbookByIdQuery
 * @package App\Domain\Guestbook\Queries
 */
class GetGuestbookByIdQuery
{
    /**
     * @var int
     */
    private $id;

    /**
     * GetGuestbookByIdQuery constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        return Guestbook::with(['image'])->findOrFail($this->id);
    }
}