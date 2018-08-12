<?php

namespace CleaniqueCoders\LaravelTaskable;

use Illuminate\Support\ServiceProvider;

class LaravelTaskableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Configuration
         */
        $this->publishes([
            __DIR__ . '/../config/taskable.php' => config_path('taskable.php'),
        ], 'laravel-taskable-config');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/taskable.php', 'taskable'
        );

        /*
         * Migration
         */
        if (! class_exists('CreateTasksTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_tasks_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_tasks_table.php'),
            ], 'laravel-taskable-migrations');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
