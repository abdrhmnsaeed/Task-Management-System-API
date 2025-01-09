<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a task
     */
    public function test_create_task()
    {
        // Create a user (you can mock or use factory)
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Authenticate the user
        $response = $this->actingAs($user, 'api')->postJson('/api/tasks', [
            'title' => 'Complete the project',
            'description' => 'Finalize all remaining tasks',
            'due_date' => '2025-01-15',
            'priority' => 'high',
        ]);

        $response->assertStatus(201) // Assert that the status is created
                 ->assertJson([
                     'title' => 'Complete the project',
                     'description' => 'Finalize all remaining tasks',
                     'priority' => 'high',
                 ]);
    }


    public function test_fetch_tasks_with_filter_and_sort()
    {
        // Create a user (you can mock or use factory)
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Create some tasks
        Task::factory()->create([
            'title' => 'Task 1',
            'priority' => 'high',
            'due_date' => '2025-01-15',
        ]);

        Task::factory()->create([
            'title' => 'Task 2',
            'priority' => 'low',
            'due_date' => '2025-02-15',
        ]);

        // Authenticate the user
        $response = $this->actingAs($user, 'api')->getJson('/api/tasks?priority=high');

        $response->assertStatus(200)
                 ->assertJsonCount(1) // Assert that only one task is returned
                 ->assertJsonFragment([
                     'title' => 'Task 1',
                     'priority' => 'high',
                 ]);
    }

    public function it_can_delete_a_task()
    {
        // Create a task
        $task = Task::factory()->create();

        // Make a DELETE request to delete the task
        $response = $this->deleteJson("/api/tasks/{$task->id}");

        // Assert the task was deleted from the database
        $response->assertStatus(200);
        $response->assertJson(['message' => 'Task deleted successfully']);

        // Assert the task is no longer in the database
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
