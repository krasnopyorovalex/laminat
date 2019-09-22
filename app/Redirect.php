<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Page
 *
 * @property int $id
 * @property string $url_old
 * @property string $url_new
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Redirect whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Redirect whereUrlNew($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Redirect whereUrlOld($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Redirect newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Redirect newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Redirect query()
 */
class Redirect extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['url_old', 'url_new'];
}
