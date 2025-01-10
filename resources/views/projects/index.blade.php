@extends('layouts.app')

@section('content')
        <h3 class="fw-semibold">Projects List</h3>
        <div class="d-flex justify-content-end">
            <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addProjectModal">Add New Project</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <form action="{{ route('projects.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control border-start-0 ps-0" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search project name, status..."
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
                            <a href="{{ route('projects.index') }}" class="btn btn-light">Reset</a>
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
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>Deadline</th>
                        <th>Staff</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->project_id }}</td>
                            <td class="text-capitalize">{{ $project->project_name }}</td>
                            <td>{{ $project->start_date ? \Carbon\Carbon::parse($project->start_date)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $project->staff }}</td>
                            <td>{{ ucfirst($project->status) }}</td>
                            <td>{{ $project->progress }}</td>
                            <td>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;"  data-bs-toggle="modal" data-bs-target="#editprojectModal{{ $project->project_id }}">Edit</button>
                                <form id="delete-form-{{ $project->project_id }}" action="{{ route('projects.destroy', $project->project_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $project->project_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit project Modal -->
                        <div class="modal fade" id="editprojectModal{{ $project->project_id }}" tabindex="-1" aria-labelledby="editprojectModalLabel{{ $project->project_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editprojectModalLabel{{ $project->project_id }}">Edit Project</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('projects.update', $project->project_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="project_name{{ $project->project_id }}" class="form-label">Project Name</label>
                                                <input type="text" class="form-control" id="project_name{{ $project->project_id }}" name="project_name" value="{{ $project->project_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="start_date{{ $project->project_id }}" class="form-label text-capitalize">Start Date</label>
                                                <input type="date" class="form-control" id="start_date{{ $project->project_id }}" name="start_date" value="{{ $project->start_date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deadline{{ $project->project_id }}" class="form-label">Deadline</label>
                                                <input type="date" class="form-control" id="deadline{{ $project->project_id }}" name="deadline" value="{{ $project->deadline }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="staff{{ $project->project_id }}" class="form-label">Staff</label>
                                                <input type="text" class="form-control" id="staff{{ $project->project_id }}" name="staff" value="{{ $project->staff }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="status{{ $project->id }}" class="form-label">Status</label>
                                                <select class="form-select" id="status{{ $project->id }}" name="status" required>
                                                    <option value="pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="on hold" {{ $project->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                    <option value="cancelled" {{ $project->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="progress{{ $project->project_id }}" class="form-label">Progress</label>
                                                <input type="number" class="form-control" id="progress{{ $project->project_id }}" name="progress" value="{{ $project->progress }}">
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
                {{ $projects->links('pagination::bootstrap-5') }}
            </div>
        </div>

    <!-- Add project Modal -->
    <div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="addProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProjectModalLabel">Add New Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('projects.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="start_date" class="form-label text-capitalize">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" required>
                        </div>
                        <div class="mb-3">
                            <label for="staff" class="form-label">Staff</label>
                            <input type="text" class="form-control" id="staff" name="staff">
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
    function confirmDelete(project_id) {
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
            document.getElementById('delete-form-' + project_id).submit();
        }
    });
}
</script>