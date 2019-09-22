<?php

namespace App\Domain\Article\Commands;

use App\Article;
use App\Domain\Article\Queries\GetArticleByIdQuery;
use App\Domain\Image\Commands\DeleteImageCommand;
use App\Domain\Image\Commands\UploadImageCommand;
use App\Events\RedirectDetected;
use App\Http\Requests\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateArticleCommand
 * @package App\Domain\Page\Commands
 */
class UpdateArticleCommand
{

    use DispatchesJobs;

    private $request;
    private $id;

    /**
     * UpdateArticleCommand constructor.
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
        $article = $this->dispatch(new GetArticleByIdQuery($this->id));
        $urlNew = $this->request->post('alias');

        if ($article->getOriginal('alias') != $urlNew) {
            event(new RedirectDetected($article->getOriginal('alias'), $urlNew, 'article.show'));
        }

        if ($this->request->has('image')) {
            if ($article->image) {
                $this->dispatch(new DeleteImageCommand($article->image));
            }
            $this->dispatch(new UploadImageCommand($this->request, $article->id, Article::class));
        }

        return $article->update($this->request->all());
    }

}