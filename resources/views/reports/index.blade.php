@extends('layouts.app')

@section('content')
        <h3 class="fw-semibold">Reports List</h3>
        <div class="d-flex justify-content-end">
            <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addreportsModal">Add New Report</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <form action="{{ route('reports.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control border-start-0 ps-0" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search type, generated by..."
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
                            <a href="{{ route('reports.index') }}" class="btn btn-light">Reset</a>
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
                        <th>Report ID</th>
                        <th>Type</th>
                        <th>Date Generated</th>
                        <th>Generated By</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $items)
                        <tr>
                            <td>{{ $items->report_id }}</td>
                            <td>{{ ucfirst($items->type) }}</td>
                            <td>{{ $items->date_generated ? \Carbon\Carbon::parse($items->date_generated)->format('d-m-Y') : '-' }}</td>
                            <td>{{ ucfirst($items->generated_by) }}</td>
                            <td>{{ $items->description }}</td>
                            <td>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;">View</button>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;"  data-bs-toggle="modal" data-bs-target="#editreportsModal{{ $items->report_id }}">Edit</button>
                                <form id="delete-form-{{ $items->report_id }}" action="{{ route('reports.destroy', $items->report_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $items->report_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit reports Modal -->
                        <div class="modal fade" id="editreportsModal{{ $items->report_id }}" tabindex="-1" aria-labelledby="editreportsModalLabel{{ $items->report_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editreportsModalLabel{{ $items->report_id }}">Edit Report</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('reports.update', $items->report_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="type{{ $items->id }}" class="form-label">Type</label>
                                                <select class="form-select" id="type{{ $items->id }}" name="type" required>
                                                    <option value="staff" {{ $items->type == 'Staff' ? 'selected' : '' }}>Staff</option>
                                                    <option value="customer" {{ $items->type == 'Customer' ? 'selected' : '' }}>Customer</option>
                                                    <option value="order" {{ $items->type == 'Order' ? 'selected' : '' }}>Order</option>
                                                    <option value="project" {{ $items->type == 'Project' ? 'selected' : '' }}>Project</option>
                                                    <option value="task" {{ $items->type == 'Task' ? 'selected' : '' }}>Task</option>
                                                    <option value="finance" {{ $items->type == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date_generated{{ $items->report_id }}" class="form-label text-capitalize">Date Generated</label>
                                                <input type="date" class="form-control" id="date_generated{{ $items->report_id }}" name="date_generated" value="{{ $items->date_generated }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="generated_by{{ $items->id }}" class="form-label">Generated By</label>
                                                <select class="form-select" id="generated_by{{ $items->id }}" name="generated_by" required>
                                                    <option value="finance" {{ $items->generated_by == 'Finance' ? 'selected' : '' }}>Finance</option>
                                                    <option value="staff" {{ $items->generated_by == 'Staff' ? 'selected' : '' }}>Staff</option>
                                                    <option value="manager" {{ $items->generated_by == 'Manager' ? 'selected' : '' }}>Manager</option>
                                                    <option value="super admin" {{ $items->generated_by == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description{{ $items->report_id }}" class="form-label">Description</label>
                                                <input type="text" class="form-control" id="description{{ $items->report_id }}" name="description" value="{{ $items->description }}" required>
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
                {{ $reports->links('pagination::bootstrap-5') }}
            </div>
        </div>

    <!-- Add reports Modal -->
    <div class="modal fade" id="addreportsModal" tabindex="-1" aria-labelledby="addreportsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addreportsModalLabel">Add New Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="staff">Staff</option>
                                <option value="customer">Customer</option>
                                <option value="order">Order</option>
                                <option value="project">Project</option>
                                <option value="task">Task</option>
                                <option value="finance">Finance</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date_generated" class="form-label text-capitalize">Date Generated</label>
                            <input type="date" class="form-control" id="date_generated" name="date_generated" required>
                        </div>
                        <div class="mb-3">
                            <label for="generated_by" class="form-label">Generated By</label>
                            <select class="form-select" id="generated_by" name="generated_by" required>
                                <option value="finance">Finance</option>
                                <option value="staff">Staff</option>
                                <option value="manager">Manager</option>
                                <option value="super admin">Super Admin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" required></textarea>
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
    function confirmDelete(report_id) {
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
            document.getElementById('delete-form-' + report_id).submit();
        }
    });
}
</script>