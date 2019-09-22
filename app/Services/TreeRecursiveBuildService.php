<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class TreeRecursiveBuildService
 * @package App\Services
 */
class TreeRecursiveBuildService
{
    /**
     * @var Collection
     */
    private $collection;

    /**
     * @var null
     */
    private $selected;

    /**
     * @var array
     */
    private $rootChildArray;

    /**
     * @param Collection $collection
     * @param null $selected
     * @return string
     */
    public function buildHtmlWithTagOption(Collection $collection, $selected = null): string
    {
        $this->collection = $collection;
        $this->selected = $selected;

        $this->buildRootChild();

        return $this->withTagOption();
    }

    /**
     * @param string $html
     * @param string $step
     * @param array $helpArray
     * @return string
     */
    private function withTagOption(string $html = '', string $step = '', $helpArray = []): string
    {
        $originArray = count($helpArray) ? $helpArray : $this->rootChildArray;

        foreach ($this->rootChildArray as $item) {
            if ( ! is_array($item)) {

                $html .= '<option value="' . $item->id . ' " ' . ($this->selected == $item->id ? 'selected=""' : '') . ' > ' . $step . $item->name . '</option>' . PHP_EOL;

                if (isset($this->rootChildArray['child_' . $item->id])) {
                    $this->rootChildArray = $originArray;
                    $html = $this->withTagOption($html, $step . '**', $this->rootChildArray);
                }
            }
        }
        return $html;
    }

    private function buildRootChild(): void
    {
        $this->collection->each(function ($item) {
            return $item->parent_id
                ? $this->rootChildArray[] = $item
                : $this->rootChildArray['child_' . $item->id] = $item;
        });
    }
}