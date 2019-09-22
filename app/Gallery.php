<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Gallery
 *
 * @property int $id
 * @property string $name
 * @property string $is_published
 * @property int $pos
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\GalleryImage[] $images
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery wherePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Gallery whereUpdatedAt($value)
 */
class Gallery extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['name', 'is_published'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\GalleryImage')->orderBy('pos');
    }
}
