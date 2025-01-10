@extends('layouts.app')

@section('content')
        <h3 class="fw-semibold">Tasks List</h3>
        <div class="d-flex justify-content-end">
            <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addTaskModal">Add New Task</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <form action="{{ route('tasks.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control border-start-0 ps-0" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search task name, assignee, status..."
                        style="border-left: none; box-shadow: none;">
                </div>
    
                <div class="dropdown">
                    <button class="btn btn-white border dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <div class="dropdown-menu p-3" style="min-width: 250px;">
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                <option value="">All Roles</option>
                                {{-- <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                <option value="supervisor" {{ request('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                                <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option> --}}
                            </select>
                        </div>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('tasks.index') }}" class="btn btn-light">Reset</a>
                            <button type="submit" class="btn text-white" style="background-color: #e65f2b;">Apply</button>
                        </div>
                    </div>
                </div>
    
                <button type="submit" class="btn text-white" style="background-color: #e65f2b;">Search</button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Task ID</th>
                        <th>Task Name</th>
                        <th>Assignee</th>
                        <th>Priority</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td>{{ $task->task_id }}</td>
                            <td class="text-capitalize">{{ $task->task_name }}</td>
                            <td class="text-capitalize">{{ $task->assignee }}</td>
                            <td>{{ ucfirst($task->priority) }}</td>
                            <td>{{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d-m-Y') : '-' }}</td>
                            <td>{{ ucfirst($task->status) }}</td>
                            <td>{{ $task->progress }}</td>
                            <td>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;"  data-bs-toggle="modal" data-bs-target="#edittaskModal{{ $task->task_id }}">Edit</button>
                                <form id="delete-form-{{ $task->task_id }}" action="{{ route('tasks.destroy', $task->task_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $task->task_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit task Modal -->
                        <div class="modal fade" id="edittaskModal{{ $task->task_id }}" tabindex="-1" aria-labelledby="edittaskModalLabel{{ $task->task_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="edittaskModalLabel{{ $task->task_id }}">Edit Task</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('tasks.update', $task->task_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="task_name{{ $task->task_id }}" class="form-label">Task Name</label>
                                                <input type="text" class="form-control" id="task_name{{ $task->task_id }}" name="task_name" value="{{ $task->task_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="assignee{{ $task->task_id }}" class="form-label">Assignee</label>
                                                <input type="text" class="form-control" id="assignee{{ $task->task_id }}" name="assignee" value="{{ $task->assignee }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="priority{{ $task->id }}" class="form-label">Priority</label>
                                                <select class="form-select" id="priority{{ $task->id }}" name="priority" required>
                                                    <option value="low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
                                                    <option value="medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
                                                    <option value="high" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
                                                    <option value="critical" {{ $task->priority == 'Critical' ? 'selected' : '' }}>Critical</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deadline{{ $task->task_id }}" class="form-label">Deadline</label>
                                                <input type="date" class="form-control" id="deadline{{ $task->task_id }}" name="deadline" value="{{ $task->deadline }}" required>
                                            </div>>
                                            <div class="mb-3">
                                                <label for="status{{ $task->id }}" class="form-label">Status</label>
                                                <select class="form-select" id="status{{ $task->id }}" name="status" required>
                                                    <option value="pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="on hold" {{ $task->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                    <option value="cancelled" {{ $task->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="progress{{ $task->task_id }}" class="form-label">Progress</label>
                                                <input type="number" class="form-control" id="progress{{ $task->task_id }}" name="progress" value="{{ $task->progress }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn text-white" style="background-color: #e65f2b;">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $tasks->links('pagination::bootstrap-5') }}
            </div>
        </div>

    <!-- Add task Modal -->
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="task_name" class="form-label">Task Name</label>
                            <input type="text" class="form-control" id="task_name" name="task_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="assignee" class="form-label text-capitalize">Assignee</label>
                            <input type="text" class="form-control" id="assignee" name="assignee" required>
                        </div>
                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-select" id="priority" name="priority" required>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="in progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="on hold">On Hold</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="progress" class="form-label">Progress</label>
                            <input type="number" class="form-control" id="progress" name="progress">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn text-white" style="background-color: #e65f2b;">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function confirmDelete(task_id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + task_id).submit();
        }
    });
}
</script>