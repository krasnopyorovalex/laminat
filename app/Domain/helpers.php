<?php

use Illuminate\Support\HtmlString;

if (! function_exists('str_template')) {
    /**
     *
     * @param string $string
     * @param array $params
     * @return mixed
     */
    function str_template(string $string, array $params = [])
    {
        $search = array_map(static function ($v) {
            return '{' . $v . '}';
        }, array_keys($params));
        return str_replace($search, array_values($params), $string);
    }
}

if (! function_exists('svg')) {
    function svg($symbol): HtmlString
    {
        return new HtmlString(
            '<svg class="icon">
                <use xlink:href="' . asset("img/symbols.svg#{$symbol}") . '"></use>
            </svg>'
        );
    }
}
if (! function_exists('build_root_child_select')) {
    /**
     * @param $collection
     * @param null $selected
     * @return string
     */
    function build_root_child_select($collection, $selected = null)
    {
        $returnedArray = [];

        foreach ($collection as $item) {
            if (!$item['parent_id']) {
                $returnedArray[] = $item;
                continue;
            }
            $returnedArray['child_' . $item['parent_id']][] = $item;
        }

        return build_options($returnedArray, $selected);
    }
}

if (! function_exists('build_options')) {
    /**
     * @param array $array
     * @param $selected
     * @param string $html
     * @param string $step
     * @param array $helpArray
     * @return string
     */
    function build_options(array $array, $selected, $html = '', $step = '', $helpArray = [])
    {
        $originArray = count($helpArray) ? $helpArray : $array;
        foreach ($array as $item) {
            if (!is_array($item)) {

                $html .= '<option value="' . $item->id . '"' . ($selected === $item->id ? 'selected=""' : '') . '>' . $step . $item->name . '</option>' . PHP_EOL;

                if (isset($originArray['child_' . $item->id])) {
                    $html = build_options($originArray['child_' . $item->id], $selected, $html, $step . '**', $array);
                }
            }
        }
        return $html;
    }
}


if (! function_exists('get_ids_from_array')) {
    /**
     * @param array $array
     * @return array
     */
    function get_ids_from_array(array $array)
    {
        return array_map(static function ($item) {
            return $item['id'];
        }, $array);
    }
}


if (! function_exists('is_main_page')) {
    /**
     * @return bool
     */
    function is_main_page()
    {
        return request()->path() === '/';
    }
}

if (! function_exists('add_css_class')) {
    /**
     * @param $item
     * @return string
     */
    function add_css_class($item)
    {
        $classes = [];

        if (count($item->menuItems)) {
            $classes[] = 'has__child';
        }

        $path = urldecode(request()->path());

        if (trim($item->link,'/') === $path || $path === $item->link) {
            $classes[] = 'active';
        }
        return count($classes) ? ' class="'. implode(' ', $classes) .'"' : '';
    }
}

if ( ! function_exists('is_checked')) {
    function is_checked(int $filterId, int $filterOptionId): string
    {
        $checkedArray = request()->get('filters');

        $result = isset($checkedArray[$filterId]) && in_array((string)$filterOptionId, $checkedArray[$filterId], true);

        return $result ? 'checked' : '';
    }
}

if ( ! function_exists('is_selected')) {
    function is_selected(string $name, string $value): string
    {
        return request()->get($name) === $value ? 'selected' : '';
    }
}
