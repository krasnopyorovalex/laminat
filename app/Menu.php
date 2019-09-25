<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Menu
 *
 * @property int $id
 * @property string $name
 * @property string $sys_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MenuItem[] $menuItems
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu whereSysName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Menu query()
 * @property-read int|null $menu_items_count
 */
class Menu extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'sys_name'];

    /**
     * @return HasMany
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
