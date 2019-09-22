<?php

namespace App\Services;

use Illuminate\Support\Str;

/**
 * Class LinkGeneratorService
 * @package App\Services
 */
class LinkGeneratorService
{
    /**
     * @var array
     */
    private $models = [
        'App\Page' => 'Страницы',
        'App\Service' => 'Услуги',
        'App\Article' => 'Статьи',
        'App\Information' => 'Новости'
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
        foreach ($this->models as $key => $value) {

            try {
                $reflectionClass = (new \ReflectionClass($key))->newInstance();
                $module = Str::lower(class_basename($reflectionClass));
                $collection = $reflectionClass::get();

                $this->result[$value] = [
                    'module' => $module,
                    'collections' => $collection
                ];
            } catch (\Exception $exception) {
                \Log::error($exception->getMessage());
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

        return str_replace(['index'], '', $route);
    }

}