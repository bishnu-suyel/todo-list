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
        ]);
    
        // Create task for the authenticated user
        $task = Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    
        // Redirect back to tasks index page
        return redirect()->route('tasks.index');
    }
    

    public function destroy(Task $task)
    {
        // Check if the authenticated user is authorized to delete the task
        if (Auth::id() === $task->user_id) {
            $task->delete();
            return back();
        }
    
        return redirect()->route('tasks.index')->withErrors('You are not authorized to delete this task.');
    }
}    
