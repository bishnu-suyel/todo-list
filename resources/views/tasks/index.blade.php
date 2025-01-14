<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="container content w-75">
            <h1 class="mb-4">Your Tasks</h1>

            <p><strong style="text-transform: uppercase;">Welcome</strong>, <span style="text-transform: uppercase;">{{ Auth::user()->name }}</span></p>
            <ol class="list-group mb-3">
                @foreach($tasks as $task)
                <li class="list-group-item mb-3 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="task-title" style="font-weight: bold;">{{ $task->title }}</div>
                        <div class="task-description" style="font-style: italic;">{{ $task->description }}</div>
                        <div class="{{ $task->completed ? 'status-completed' : 'status-not-completed' }}">
                            <!-- Toggle Completed Status Checkbox -->

                            <form action="{{ route('tasks.toggle', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input
                                    type="checkbox"
                                    name="completed"
                                    value="1"
                                    {{ $task->completed ? 'checked' : '' }}
                                    onchange="this.form.submit()">

                                <span class="{{ $task->completed ? 'text-success' : 'text-danger' }}">
                                    {{ $task->completed ? 'Completed' : 'Not Completed' }}
                                </span>
                            </form>
                        </div>
                    </div>
                    <div class="d-flex">
                        <!-- Edit Button -->
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <!-- Delete Button -->
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm me-2">Delete</button>
                        </form>
                    </div>
                </li>
                @endforeach

            </ol>

            <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3 w-75">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>

                <div class="mb-3 w-75">
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