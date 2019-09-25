<?php

declare(strict_types=1);

namespace App\Filter;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;

/**
 * Class CatalogProductFilter
 * @package App\Filter
 */
final class CatalogProductFilter extends Filter
{
    /**
     * Registered sorts to operate upon.
     *
     * @var array
     */
    protected $filters = ['filters', 'priceFrom', 'priceTo', 'price', 'name'];

    /**
     * @param array $filters
     * @return Builder
     */
    protected function filters(array $filters): Builder
    {
        $uniqueTablePostfix = 1;

        $query = DB::table('catalog_product_filter as cpf_1')
            ->distinct()
            ->select('cpf_1.catalog_product_id');

        foreach ($filters as $filter => $filterOptions) {

            $uniqueTablePostfix++;

            $query->join("catalog_product_filter as cpf_$uniqueTablePostfix", static function (JoinClause $join) use ($uniqueTablePostfix) {

                $join->on('cpf_1.catalog_product_id', '=', 'cpf_'.$uniqueTablePostfix.'.catalog_product_id');

            })->where('cpf_'.$uniqueTablePostfix.'.filter_id', (int)$filter)
                ->whereIn('cpf_'.$uniqueTablePostfix.'.filter_option_id', (array)$filterOptions);
        }

        $catalogProductIds = $query->get()->pluck('catalog_product_id')->toArray();

        return $this->builder->whereIn('id', $catalogProductIds);
    }

    /**
     * @param string $price
     * @return Builder
     */
    protected function priceFrom(string $price): Builder
    {
        return $this->builder->where('price', '>=', (int)$price);
    }

    /**
     * @param string $price
     * @return Builder
     */
    protected function priceTo(string $price): Builder
    {
        return $this->builder->where('price', '<=', (int)$price);
    }

    /**
     * Filter the query by a given price.
     *
     * @param string $value
     * @return Builder
     */
    protected function price(string $value): Builder
    {
        return $this->builder->orderBy('price', $value);
    }

    /**
     * Filter the query by a given name.
     *
     * @param string $value
     * @return Builder
     */
    protected function name(string $value): Builder
    {
        return $this->builder->orderBy('name', $value);
    }
}
