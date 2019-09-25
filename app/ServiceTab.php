<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ServiceTab
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ServiceTab newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ServiceTab newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ServiceTab query()
 * @mixin \Eloquent
 */
class ServiceTab extends Model
{

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['service_id', 'tab_id', 'value'];
}
