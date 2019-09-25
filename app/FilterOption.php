<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyProducts;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class FilterOption
 *
 * @package App
 * @property int $id
 * @property int $filter_id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CatalogProduct[] $catalogProducts
 * @property-read int|null $catalog_products_count
 * @property-read \App\Filter $filter
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterOption newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterOption newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterOption query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterOption whereFilterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterOption whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\FilterOption whereName($value)
 * @mixin \Eloquent
 */
class FilterOption extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    /**
     * @return HasOne
     */
    public function filter(): HasOne
    {
        return $this->hasOne(Filter::class, 'id', 'filter_id');
    }

    /**
     * @return BelongsToManyProducts
     */
    public function catalogProducts(): BelongsToManyProducts
    {
        return $this->belongsToMany(CatalogProduct::class)->using(CatalogProductFilter::class);
    }
}
