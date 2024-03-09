<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait OrderByDesc
{
    protected static function bootOrderByDesc()
    {
        static::addGlobalScope('orderByDesc', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}
