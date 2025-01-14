<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex justify-content-center">
        <div class="container w-75">
            <h1>Edit Task</h1>

            <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="mb-4">
                @csrf
                @method('PATCH') <!-- Ensure that the method is PATCH to update the task -->

                <div class="mb-3">
                    <label for="title" class="form-label">Task Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Task Description</label>
                    <input type="text" id="description" name="description" class="form-control" value="{{ old('description', $task->description) }}" required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Task</button>
            </form>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary mt-2">Back to Lists</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>