<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 */
class MenuItem extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'link', 'menu_id', 'parent_id', 'pos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function menu()
    {
        return $this->hasOne('App\Menu');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuItems()
    {
        return $this->hasMany('App\MenuItem', 'parent_id', 'id')->orderBy('pos');
    }
}
