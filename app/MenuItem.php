<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\MenuItem
 *
 * @property int $id
 * @property int $menu_id
 * @property int|null $parent_id
 * @property string $name
 * @property string $link
 * @property int $pos
 * @property-read \App\Menu $menu
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\MenuItem[] $menuItems
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem wherePos($value)
 * @property-read int|null $menu_items_count
 */
class MenuItem extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'link', 'menu_id', 'parent_id', 'pos'];

    /**
     * @return HasOne
     */
    public function menu(): HasOne
    {
        return $this->hasOne(Menu::class);
    }

    /**
     * @return HasMany
     */
    public function menuItems(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->orderBy('pos');
    }
}
