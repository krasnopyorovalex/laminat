<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Image
 *
 * @property int $id
 * @property string $path
 * @property string|null $title
 * @property string|null $alt
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereTitle($value)
 * @mixin \Eloquent
 * @property-read \App\Page $page
 * @property int $imageable_id
 * @property string $imageable_type
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $imageable
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereImageableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image whereImageableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Image query()
 */
class Image extends Model
{

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['path', 'alt', 'title', 'imageable_id', 'imageable_type'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function imageable()
    {
        return $this->morphTo();
    }
}
