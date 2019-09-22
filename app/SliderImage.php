<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SliderImage
 *
 * @property int $id
 * @property int $slider_id
 * @property string|null $name
 * @property string $link
 * @property string|null $alt
 * @property string|null $title
 * @property string $basename
 * @property string $ext
 * @property string $is_published
 * @property int $pos
 * @mixin \Eloquent
 * @property-read \App\Slider $slider
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereAlt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereBasename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereExt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereIsPublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage wherePos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereSliderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereTitle($value)
 * @property string|null $sub
 * @property string|null $desc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\SliderImage whereSub($value)
 */
class SliderImage extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['slider_id', 'sub', 'name', 'desc', 'link', 'alt', 'title', 'is_published', 'pos'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function slider()
    {
        return $this->belongsTo('App\Slider');
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return asset('storage/slider/' . $this->slider_id . '/' . $this->basename . '_thumb.' . $this->ext);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return asset('storage/slider/' . $this->slider_id . '/' . $this->basename . '.' . $this->ext);
    }
}
