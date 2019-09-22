<?php

namespace App\Domain\Guestbook\Queries;

use App\Guestbook;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class GetAllGuestbookQuery
 * @package App\Domain\Guestbook\Queries
 */
class GetAllGuestbookQuery
{
    /**
     * @var bool
     */
    private $isPublished;

    /**
     * @var int
     */
    private $limit;

    public function __construct(bool $isPublished = false, int $limit = 0)
    {
        $this->isPublished = $isPublished;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $guestbooks = Guestbook::orderBy('published_at', 'desc');

        if ($this->isPublished) {
            $guestbooks->where('is_published', '1');
        }

        if ($this->limit) {
            $result = $guestbooks->paginate($this->limit, array('*'), 'page', intval(request('page')));

            if (! $result->count()) {
                throw new NotFoundHttpException();
            }

            return $result;
        }

        return $guestbooks->get();
    }
}
