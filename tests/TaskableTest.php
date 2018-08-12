<?php

namespace CleaniqueCoders\LaravelTaskable\Tests;

class TaskableTest extends TestCase
{
    protected function tearDown()
    {
        $path = base_path('vendor/orchestra/testbench-core/laravel/database/migrations/*.php');
        collect(glob($path))
            ->each(function ($path) {
                unlink($path);
            });
        unlink(config_path('taskable.php'));
    }

    /** @test */
    public function it_has_config_file()
    {
        $this->assertHasConfig('taskable.php');
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
    }
}
