<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .task-description {
            font-style: italic;
            color: #6c757d;
        }
        .status-completed {
            color: green;
            font-weight: bold;
        }
        .status-not-completed {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center">
        <div class="container content w-75"> <!-- Adjust width as needed -->
            <h1 class="mb-4">Your Tasks</h1>

            <p>Welcome, {{ Auth::user()->name }}</p> <!-- Display authenticated user's name -->

            <ol class="list-group mb-3 w-75">
                @foreach($tasks as $task)
                    <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                        <div>
                            <div class="task-title">{{ $task->title }}</div>
                            <div class="task-description">{{ $task->description }}</div>
                            <div class="{{ $task->completed ? 'status-completed' : 'status-not-completed' }}">
                                {{ $task->completed ? 'Completed' : 'Not Completed' }}
                            </div>
                        </div>
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="margin-left: auto;">
                            @csrf
                            @method('PATCH')
                            <input 
                                type="checkbox" 
                                name="completed" 
                                value="1" 
                                {{ $task->completed ? 'checked' : '' }} 
                                onchange="this.form.submit()">
                        </form>
                    </li>
                @endforeach
            </ol>

            <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3 w-50">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-3 w-50">
                    <label for="description" class="form-label">Task Description</label>
                    <input type="text" id="description" name="description" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Task</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
