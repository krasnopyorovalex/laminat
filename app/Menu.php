<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 */
class Menu extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'sys_name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menuItems()
    {
        return $this->hasMany('App\MenuItem');
    }
}
