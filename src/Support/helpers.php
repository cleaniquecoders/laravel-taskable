<?php


if (! function_exists('task')) {
    function task($identifier = null)
    {
        return \CleaniqueCoders\LaravelTaskable\Services\TaskService::make($identifier);
    }
}
