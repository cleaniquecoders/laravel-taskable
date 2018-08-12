<?php

namespace CleaniqueCoders\LaravelTaskable;

/*
 * This file is part of laravel-taskable
 *
 * @license MIT
 * @package laravel-taskable
 */

use Illuminate\Support\Facades\Facade;

class LaravelTaskableFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'LaravelTaskable';
    }
}
