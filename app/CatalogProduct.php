<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Builder;
use App\Filter\CatalogProductFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use App\CatalogProductFilter as CatalogProductFilterModel;
use Illuminate\Support\HtmlString;

/**
 * App\CatalogProduct
 *
 * @property int $id
 * @property int|null $catalog_id
 * @property string $name
 * @property string $title
 * @property string|null $description
 * @property string|null $keywords
 * @property string $text
 * @property string $alias
 * @property integer $price
 * @property string $is_published
 * @property int $pos
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Catalog $catalog
 * @mixin \Eloquent
 * @mixin CatalogProductFilter
 * @property string|null $label
 * @property-read Collection|Filter[] $filter
 * @property-read int|null $filter_count
 * @property-read Collection|FilterOption[] $filterOptions
 * @property-read int|null $filter_options_count
 * @property-read string $url
 * @property-read Image $image
 * @method static Builder|CatalogProduct newModelQuery()
 * @method static Builder|CatalogProduct newQuery()
 * @method static Builder|CatalogProduct query()
 * @method static Builder|CatalogProduct sort(CatalogProductFilter $filter)
 */
class CatalogProduct extends Model
{
    use AutoAliasTrait;

    private const LABELS = [
        '' => 'Не выбрано',
        'info' => 'Акция!',
        'new' => 'Новинка!'
    ];

    protected $with = ['catalog', 'image'];

    /**
     * @var array
     */
    protected $fillable = ['catalog_id', 'price', 'name', 'title', 'description', 'text', 'alias', 'label', 'pos'];

    /**
     * @return HasOne
     */
    public function catalog(): HasOne
    {
        return $this->hasOne(Catalog::class, 'id', 'catalog_id');
    }

    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'catalog_product_filter')->using(CatalogProductFilterModel::class);
    }

    public function filterOptions()
    {
        return $this->belongsToMany(FilterOption::class, 'catalog_product_filter')->using(CatalogProductFilterModel::class);
    }

    /**
     * @return MorphOne
     */
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    /**
     * @return string
     */
    public function getUrlAttribute(): string
    {
        return route('catalog_product.show', $this->alias);
    }

    /**
     * @return HtmlString
     */
    public function getPrice(): HtmlString
    {
        return new HtmlString(sprintf('%s &#8381;', number_format($this->price, 0, '.', ' ')));
    }

    /**
     * @return array
     */
    public function getLabels(): array
    {
        return self::LABELS;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getLabelName(string $key)
    {
        return self::LABELS[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isSelectedLabel(string $key): bool
    {
        return $key === $this->label;
    }

    /**
     * @param FilterOption $filterOption
     * @return bool
     */
    public function isCheckedFilterOption(FilterOption $filterOption): bool
    {
        $filterOptions = $this->filterOptions->pluck('id')->toArray();

        return in_array($filterOption->id, $filterOptions, true);
    }

    /**
     * Apply all relevant products by filters.
     *
     * @param Builder $query
     * @param CatalogProductFilter $filter
     * @return Builder
     */
    public function scopeByFilter($query, CatalogProductFilter $filter): Builder
    {
        return $filter->apply($query);
    }
}
