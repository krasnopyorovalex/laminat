<?php

namespace App\Services;

use Exception;
use Log;
use Illuminate\Support\Str;
use App\Page;
use App\Article;
use ReflectionClass;
use App\Catalog;

/**
 * Class LinkGeneratorService
 * @package App\Services
 */
class LinkGeneratorService
{
    /**
     * @var array
     */
    private const MODELS = [
        Page::class => 'Страницы',
        Article::class => 'Статьи',
        Catalog::class => 'Каталог'
    ];

    /**
     * @var array
     */
    private $result = [];

    /**
     * @return array
     */
    public function getCollection(): array
    {
        foreach (self::MODELS as $key => $value) {

            try {
                $reflectionClass = (new ReflectionClass($key))->newInstance();
                $module = Str::lower(class_basename($reflectionClass));
                $collection = $reflectionClass::get();

                $this->result[$value] = [
                    'module' => $module,
                    'collections' => $collection
                ];
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
        }

        return $this->result;
    }

    /**
     * @param string $modelName
     * @param string $alias
     * @return string
     */
    public function createLink(string $modelName, string $alias): string
    {
        $route = route($modelName . '.show', ['alias' => $alias], false);

        return str_replace('index', '', urldecode($route));
    }

}
