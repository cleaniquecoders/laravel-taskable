<?php

namespace CleaniqueCoders\LaravelTaskable\Traits;

use Illuminate\Support\Str;

trait TaskableTrait
{
    abstract public function getTaskableLabelAttribute(): string;

    abstract public function getTaskableNameAttribute(): string;

    public function getTableName(): string
    {
        if (! isset($this->table)) {
            return Str::lower(Str::plural(class_basename(fqcn($this))));
        }

        return $this->table;
    }

    public function getTaskableColumns()
    {
        $schema = \DB::connection(config('database.default'))
            ->getDoctrineConnection()
            ->getSchemaManager();
        $taskable_columns = isset($this->taskable_columns) ? $this->taskable_columns : [];

        $columns = collect($schema->listTableColumns($this->getTableName()))
            ->reject(function ($column) {
                return $column->getNotNull();
            })
            ->reject(function ($column) {
                return in_array($column->getName(), ['id', 'hashslug', 'deleted_at', 'created_at', 'updated_at']);
            });

        $columns = collect($columns->keys()->toArray());

        if (sizeof($taskable_columns) > 0) {
            $columns = $columns->concat($taskable_columns);
        }

        return $columns->toArray();
    }

    public function getIsTableFilledAttribute()
    {
        foreach ($this->getTaskableColumns() as $column) {
            if (isset($this->{$column}) && blank($this->{$column})) {
                return false;
            }
        }

        return true;
    }

    public function getDependencyTasksIsDoneAttribute(): bool
    {
        return true;
    }

    public function getTaskIsDoneAttribute(): bool
    {
        return ($this->is_table_filled) ? $this->dependency_tasks_is_done : false;
    }

    public function tasks()
    {
        return $this->morphMany(config('taskable.models.task'), 'taskable');
    }
}
