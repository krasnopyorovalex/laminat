<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Class CatalogProductFilter
 *
 * @package App
 * @property int $catalog_product_id
 * @property int $filter_id
 * @property int $filter_option_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CatalogProductFilter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CatalogProductFilter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CatalogProductFilter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CatalogProductFilter whereCatalogProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CatalogProductFilter whereFilterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CatalogProductFilter whereFilterOptionId($value)
 * @mixin \Eloquent
 */
class CatalogProductFilter extends Pivot
{
    public $timestamps = false;
}
