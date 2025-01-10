@extends('layouts.app')

@section('content')
        <h3 class="fw-semibold">Orders List</h3>
        <div class="d-flex justify-content-end">
            <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addOrderModal">Add New Order</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <form action="{{ route('orders.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control border-start-0 ps-0" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search service, status..."
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
                            <a href="{{ route('orders.index') }}" class="btn btn-light">Reset</a>
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
                        <th>Order ID</th>
                        <th>Service</th>
                        <th>Details</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td class="text-capitalize">{{ $order->service }}</td>
                            <td>{{ $order->details }}</td>
                            <td>{{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d-m-Y') : '-' }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                            <td>{{ $order->price }}</td>
                            <td>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;"  data-bs-toggle="modal" data-bs-target="#editorderModal{{ $order->order_id }}">Edit</button>
                                <form id="delete-form-{{ $order->order_id }}" action="{{ route('orders.destroy', $order->order_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $order->order_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit order Modal -->
                        <div class="modal fade" id="editorderModal{{ $order->order_id }}" tabindex="-1" aria-labelledby="editorderModalLabel{{ $order->order_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editorderModalLabel{{ $order->order_id }}">Edit Order</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('orders.update', $order->order_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="service{{ $order->order_id }}" class="form-label">Service</label>
                                                <input type="text" class="form-control" id="service{{ $order->order_id }}" name="service" value="{{ $order->service }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="details{{ $order->order_id }}" class="form-label text-capitalize">Details</label>
                                                <input type="text" class="form-control" id="details{{ $order->order_id }}" name="details" value="{{ $order->details }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="order_date{{ $order->order_id }}" class="form-label">Order Date</label>
                                                <input type="date" class="form-control" id="order_date{{ $order->order_id }}" name="order_date" value="{{ $order->order_date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status{{ $order->id }}" class="form-label">Status</label>
                                                <select class="form-select" id="status{{ $order->id }}" name="status" required>
                                                    <option value="pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="in progress" {{ $order->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                                    <option value="completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="on hold" {{ $order->status == 'On Hold' ? 'selected' : '' }}>On Hold</option>
                                                    <option value="cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="price{{ $order->order_id }}" class="form-label">Price</label>
                                                <input type="number" class="form-control" id="price{{ $order->order_id }}" name="price" value="{{ $order->price }}">
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
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>

    <!-- Add order Modal -->
    <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addOrderModalLabel">Add New Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="service" class="form-label">Service</label>
                            <input type="text" class="form-control" id="service" name="service" required>
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label text-capitalize">Details</label>
                            <input type="text" class="form-control" id="details" name="details" required>
                        </div>
                        <div class="mb-3">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="date" class="form-control" id="order_date" name="order_date" required>
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
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price">
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
    function confirmDelete(order_id) {
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
            document.getElementById('delete-form-' + order_id).submit();
        }
    });
}
</script>