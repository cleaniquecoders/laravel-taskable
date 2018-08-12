<?php

namespace CleaniqueCoders\LaravelTaskable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function taskable()
    {
        return $this->morphTo();
    }

    public function scopeFindByIdentifier($query, $indentifier)
    {
        return $query->where('slug', $identifier)
            ->orWhere('id', $identifier)
            ->orWhere('hashslug', $identifier)
            ->findOrFail();
    }

    public function scopeIsDone($query, $is_done = true)
    {
        return $query->where('is_done', $is_done);
    }

    public function scopeMarkAsDone($query, Model $model, string $done_remarks)
    {
        return $query->where('taskable_id', $model->od)
            ->where('taskable_type', fqcn($model))
            ->isDone(false)
            ->update([
                'is_done'      => true,
                'done_at'      => now(),
                'done_remarks' => $done_remarks,
            ]);
    }
}
