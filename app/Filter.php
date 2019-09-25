<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany as BelongsToManyProducts;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Filter
 *
 * @package App
 * @property int $id
 * @property string $name
 * @property int $pos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CatalogProduct[] $catalogProducts
 * @property-read int|null $catalog_products_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\FilterOption[] $filterOptions
 * @property-read int|null $filter_options_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Filter wherePos($value)
 * @mixin \Eloquent
 */
class Filter extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $with = ['filterOptions'];

    /**
     * @return HasMany
     */
    public function filterOptions(): HasMany
    {
        return $this->hasMany(FilterOption::class);
    }

    /**
     * @return BelongsToManyProducts
     */
    public function catalogProducts(): BelongsToManyProducts
    {
        return $this->belongsToMany(CatalogProduct::class)->using(CatalogProductFilter::class);
    }
}
