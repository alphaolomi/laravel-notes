<?php

namespace AlphaOlomi\Notes\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlphaOlomi\Notes\LaravelNotes
 */
class LaravelNotes extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AlphaOlomi\Notes\LaravelNotes::class;
    }
}
