<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();  // Get the authenticated user
            $tasks = $user->tasks;  // Access tasks relationship
         
            return view('tasks.index', compact('tasks'));
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
        ]);
    
        // Create task for the authenticated user
        $task = Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        // Redirect back to tasks index page
        return redirect()->route('tasks.index');
    }

    // Show the task edit form
    public function edit(Task $task)
    {
        // Check if the authenticated user is authorized to edit the task
        if (Auth::id() !== $task->user_id) {
            return redirect()->route('tasks.index')->withErrors('You are not authorized to edit this task.');
        }

        // Return the edit view with the task
        return view('tasks.edit', compact('task'));
    }

    // Update the task's title and description
    public function update(Request $request, $id)
{
    $task = Task::findOrFail($id);

    // Ensure the authenticated user is the owner of the task
    if (Auth::id() !== $task->user_id) {
        return redirect()->route('tasks.index')->withErrors('You are not authorized to update this task.');
    }

    // Validate the incoming request data
    $request->validate(['title' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
    ]);

    // Update the task's title and description
    $task->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    return redirect()->route('tasks.index');
}

    public function toggleCompletion(Task $task)
    {
        // Check if the authenticated user is the owner of the task
        if (Auth::id() !== $task->user_id) {
            return redirect()->route('tasks.index')->withErrors('You are not authorized to update this task.');
        }
    
        // Toggle the completion status
        $task->completed = !$task->completed;  // This toggles the boolean value
        $task->save();
    
        return redirect()->route('tasks.index');
    }
    


    // Delete the task
    public function destroy(Task $task)
{
    // Check if the authenticated user is authorized to delete the task
    if (Auth::id() === $task->user_id) {
        $task->delete();
        return back()->with('success', 'Task deleted successfully!');
    }

    return redirect()->route('tasks.index')->withErrors('You are not authorized to delete this task.');
}

}
