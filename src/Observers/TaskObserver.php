<?php

namespace \CleaniqueCoders\LaravelTaskable\Observers;

use Illuminate\Database\Eloquent\Model;

class TaskObserver
{
    /**
     * Listen to the created event.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function created(Model $model)
    {
        task()->create($model);
    }

    /**
     * Listen to the updated event.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function updated(Model $model)
    {
        task()->markAsDone($model);
    }
}
