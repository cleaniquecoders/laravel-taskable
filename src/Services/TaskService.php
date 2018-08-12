<?php

namespace CleaniqueCoders\LaravelTaskable\Services;

use Illuminate\Database\Eloquent\Model;

class TaskService
{
    public $task;

    public function __construct($identifier = null)
    {
        if (! is_null($identifier)) {
            $this->task = config('taskable.models.task')::findByIdentifier($identifier);
        }
    }

    public static function make($identifier = null)
    {
        return new self($identifier);
    }

    /**
     * Create a new task.
     *
     * task()->create($model);
     *
     * @param object $taskable_type
     *
     * @return \App\Models\Task
     */
    public function create(Model $model)
    {
        $title = method_exists($model, 'getTaskTitleAttribute') ? $model->task_title : config('taskable.default_task');
        $description = method_exists($model, 'getTaskDescriptionAttribute') ? $model->task_description : '';

        $this->task = config('taskable.models.task')::create([
            'taskable_id'   => $model->id,
            'taskable_type' => fqcn($model),
            'title'         => $title,
            'description'   => $description,
        ]);

        return $this;
    }

    /**
     * Mark a task as done.
     *
     * task('identifier')->markAsDone($model);
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     *
     * @return bool
     */
    public function markAsDone(Model $model)
    {
        $done_remarks = method_exists($model, 'getDoneRemarksAttribute') ? $model->done_remarks : '-';
        return config('taskable.models.task')::markAsDone($model, $done_remarks);
    }
}
