<?php


return [
	'default_task' => 'Todo',
    'models' => [
        'task' => \CleaniqueCoders\LaravelTaskable\Models\Task::class,
    ],
    'tables' => [
        'prefix' => '',
        'names'  => [
            'tasks',
        ],
    ],
];
