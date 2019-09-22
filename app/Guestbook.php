<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Guestbook
 *
 * @property int $id
 * @property string $name
 * @property string $text
 * @property int $pos
 * @property string $published_at
 * @property-read \App\Image $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook wherePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Guestbook whereText($value)
 * @mixin \Eloquent
 */
class Guestbook extends Model
{
    public $timestamps = false;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at'
    ];

    /**
     * @var array
     */
    protected $fillable = ['name', 'text', 'city', 'is_published', 'published_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function image()
    {
        return $this->morphOne('App\Image', 'imageable');
    }
}
