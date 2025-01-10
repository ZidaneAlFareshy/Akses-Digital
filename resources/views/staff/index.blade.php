@extends('layouts.app')

@section('content')
    <h3 class="fw-semibold">Staff List</h3>
    <div class="d-flex justify-content-end">
        <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addStaffModal">Add New Staff</button>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
        <form action="{{ route('staff.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
            <div class="input-group">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input 
                    type="text" 
                    class="form-control border-start-0 ps-0" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search staff name, email..."
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
                            <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="supervisor" {{ request('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>Staff</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('staff.index') }}" class="btn btn-light">Reset</a>
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
                    <th>Email</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Birth Date</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $staff)
                    <tr>
                        <td>{{ $staff->email }}</td>
                        <td class="text-capitalize">{{ $staff->name }}</td>
                        <td>{{ $staff->phone_number }}</td>
                        <td>{{ $staff->staff_birth_date ? \Carbon\Carbon::parse($staff->staff_birth_date)->format('d-m-Y') : '-' }}</td>
                        <td>{{ ucfirst($staff->role) }}</td>
                        <td>
                            <button 
                                class="btn text-white btn-sm" 
                                style="background-color: #e65f2b;" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editStaffModal{{ $staff->id }}">
                                Edit
                            </button>
                            <form id="delete-form-{{ $staff->id }}" action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $staff->id }})">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Staff Modal -->
                    <div class="modal fade" id="editStaffModal{{ $staff->id }}" tabindex="-1" aria-labelledby="editStaffModalLabel{{ $staff->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editStaffModalLabel{{ $staff->id }}">Edit Staff</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('staff.update', $staff) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name{{ $staff->id }}" class="form-label text-capitalize">Name</label>
                                            <input type="text" class="form-control" id="name{{ $staff->id }}" name="name" value="{{ $staff->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email{{ $staff->id }}" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email{{ $staff->id }}" name="email" value="{{ $staff->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone_number{{ $staff->id }}" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" id="phone_number{{ $staff->id }}" name="phone_number" value="{{ $staff->phone_number }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="staff_birth_date{{ $staff->id }}" class="form-label">Birth Date</label>
                                            <input type="date" class="form-control" id="staff_birth_date{{ $staff->id }}" name="staff_birth_date" value="{{ $staff->staff_birth_date }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="role{{ $staff->id }}" class="form-label">Role</label>
                                            <select class="form-select" id="role{{ $staff->id }}" name="role" required>
                                                <option value="super admin" {{ $staff->role == 'super admin' ? 'selected' : '' }}>Super Admin</option>
                                                <option value="manager" {{ $staff->role == 'manager' ? 'selected' : '' }}>Manager</option>
                                                <option value="staff" {{ $staff->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                                <option value="finance" {{ $staff->role == 'finance' ? 'selected' : '' }}>Finance</option>
                                            </select>
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
            {{ $staffs->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Add Staff Modal -->
    <div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStaffModalLabel">Add New Staff</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('staff.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label text-capitalize">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                        </div>
                        <div class="mb-3">
                            <label for="staff_birth_date" class="form-label">Birth Date</label>
                            <input type="date" class="form-control" id="staff_birth_date" name="staff_birth_date">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="super admin">Super Admin</option>
                                <option value="manager">Manager</option>
                                <option value="staff">Staff</option>
                                <option value="finance">Finance</option>
                            </select>
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
    function confirmDelete(id) {
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
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>
