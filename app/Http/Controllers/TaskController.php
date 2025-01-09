<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Create a task
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task = Task::create($data);

        return response()->json($task, 201);
    }

    // Fetch all tasks with filtering and sorting
    public function index(Request $request)
    {
        $query = Task::query();

        if ($request->has('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->has('due_date')) {
            $query->whereBetween('due_date', explode(',', $request->due_date));
        }

        $tasks = $query->orderBy('due_date', 'asc')->get();

        return response()->json($tasks);
    }

    // Fetch a single task by ID
    public function show($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        return response()->json($task);
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'due_date' => 'sometimes|date',
            'priority' => 'sometimes|in:low,medium,high',
        ]);

        $task->update($data);

        return response()->json($task);
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}


?>
