<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_get_tasks()
    {
        $user = User::factory()->create();
        Task::factory()->count(5)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/tasks');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    public function test_authenticated_user_can_create_task()
    {
        $user = User::factory()->create();

        $data = ['title' => 'New Task', 'body' => 'New Task body'];

        $response = $this->actingAs($user)->postJson('/api/tasks', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'New Task']);
    }

    public function test_authenticated_user_can_delete_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(204);
    }
}
