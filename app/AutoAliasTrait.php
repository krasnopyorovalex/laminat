<?php

namespace App;


trait AutoAliasTrait
{
    /**
     * @param string $value
     */
    public function setAliasAttribute(string $value): void
    {
        $this->attributes['alias'] = str_slug($value);
    }
}