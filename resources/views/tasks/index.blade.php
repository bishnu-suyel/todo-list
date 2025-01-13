<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
</head>
<body>
    <h1>Your Tasks</h1>
    
    <p>Welcome, {{ Auth::user()->name }}</p> <!-- Display authenticated user's name -->

    <ul>
        @foreach($tasks as $task)
            <li>
                {{ $task->title }} - {{ $task->completed ? 'Completed' : 'Not Completed' }}
            </li>
        @endforeach
    </ul>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label for="title">Task Title</label>
        <input type="text" name="title" required>
        
        <label for="description">Task Description</label>
        <input type="text" name="description" required>

        <button type="submit">Add Task</button>
    </form>
</body>
</html>
