<?php

namespace App\Providers;

use App\Interfaces\TaskRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Models\Task;
use App\Policies\TaskPolicy;
use App\Repositories\TaskRepository;

class AppServiceProvider extends ServiceProvider
{

    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

   
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }

    
    public function boot(): void
    {
        //
    }
}
