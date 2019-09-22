<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceTab extends Model
{

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['service_id', 'tab_id', 'value'];
}
