<?php

namespace CleaniqueCoders\LaravelTaskable\Tests;

class TaskableTest extends TestCase
{
    /** @test */
    public function it_has_config_file()
    {
        $this->assertHasConfig('taskable');
    }

    /** @test */
    public function it_has_helper()
    {
        $this->assertHasHelper('task');
    }

    /** @test */
    public function it_has_service()
    {
        $this->assertHasClass(\CleaniqueCoders\LaravelTaskable\Services\TaskService::class);
    }

    /** @test */
    public function it_has_model()
    {
        $this->assertHasClass(\CleaniqueCoders\LaravelTaskable\Models\Task::class);
    }

    /** @test */
    public function it_has_users_table()
    {
        $this->assertHasTable('users');
    }

    /** @test */
    public function it_has_tasks_table()
    {
        $this->assertHasMigration('CreateTasksTable');
        $this->assertHasTable('tasks');
        $this->assertTableHasColumns('tasks', [
            'id', 'hashslug', 'taskable_id', 'taskable_type',
            'slug', 'name', 'description', 'is_done', 'done_at',
            'done_remarks', 'deleted_at', 'created_at', 'updated_at',
        ]);
    }
}
