@extends('layouts.app')

@section('content')
        <h3 class="fw-semibold">Customers List</h3>
        <div class="d-flex justify-content-end">
            <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addCustomerModal">Add New Customer</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <form action="{{ route('customers.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control border-start-0 ps-0" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search customer name, email, company..."
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
                            <a href="{{ route('customers.index') }}" class="btn btn-light">Reset</a>
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
                        <th>ID</th>
                        <th>Email</th>
                        <th>Customer Name</th>
                        <th>Phone Number</th>
                        <th>Company</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>{{ $customer->customer_id }}</td>
                            <td>{{ $customer->email }}</td>
                            <td class="text-capitalize">{{ $customer->customer_name }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{{ $customer->company }}</td>
                            <td>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;"  data-bs-toggle="modal" data-bs-target="#editCustomerModal{{ $customer->customer_id }}">Edit</button>
                                <form id="delete-form-{{ $customer->customer_id }}" action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $customer->customer_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit Customer Modal -->
                        <div class="modal fade" id="editCustomerModal{{ $customer->customer_id }}" tabindex="-1" aria-labelledby="editCustomerModalLabel{{ $customer->customer_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCustomerModalLabel{{ $customer->customer_id }}">Edit Customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('customers.update', $customer->customer_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="email{{ $customer->customer_id }}" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email{{ $customer->customer_id }}" name="email" value="{{ $customer->email }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="customer_name{{ $customer->customer_id }}" class="form-label text-capitalize">Name</label>
                                                <input type="text" class="form-control" id="customer_name{{ $customer->customer_id }}" name="customer_name" value="{{ $customer->customer_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone_number{{ $customer->customer_id }}" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control" id="phone_number{{ $customer->customer_id }}" name="phone_number" value="{{ $customer->phone_number }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="company{{ $customer->customer_id }}" class="form-label">Company</label>
                                                <input type="text" class="form-control" id="company{{ $customer->customer_id }}" name="company" value="{{ $customer->company }}">
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
                {{ $customers->links('pagination::bootstrap-5') }}
            </div>
        </div>

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_name" class="form-label text-capitalize">Name</label>
                            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="company" class="form-label">Company</label>
                            <input type="text" class="form-control" id="company" name="company">
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
    function confirmDelete(customer_id) {
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
            document.getElementById('delete-form-' + customer_id).submit();
        }
    });
}
</script>