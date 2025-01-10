@extends('layouts.app')

@section('content')
        <h3 class="fw-semibold">Finance List</h3>
        <div class="d-flex justify-content-end">
            <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addFinanceModal">Add New Income</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <form action="{{ route('finance.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control border-start-0 ps-0" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search customer name, project name, amount..."
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
                            <a href="{{ route('finance.index') }}" class="btn btn-light">Reset</a>
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
                        <th>Income ID</th>
                        <th>Customer Name</th>
                        <th>Project Name</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment Method</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($finance as $items)
                        <tr>
                            <td>{{ $items->income_id }}</td>
                            <td class="text-capitalize">{{ $items->customer_name }}</td>
                            <td class="text-capitalize">{{ $items->project_name }}</td>
                            <td>{{ $items->amount }}</td>
                            <td>{{ $items->date ? \Carbon\Carbon::parse($items->date)->format('d-m-Y') : '-' }}</td>
                            <td>{{ ucfirst($items->payment_method) }}</td>
                            <td>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;"  data-bs-toggle="modal" data-bs-target="#editfinanceModal{{ $items->income_id }}">Edit</button>
                                <form id="delete-form-{{ $items->income_id }}" action="{{ route('finance.destroy', $items->income_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $items->income_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit finance Modal -->
                        <div class="modal fade" id="editfinanceModal{{ $items->income_id }}" tabindex="-1" aria-labelledby="editfinanceModalLabel{{ $items->income_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editfinanceModalLabel{{ $items->income_id }}">Edit Income</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('finance.update', $items->income_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="customer_name{{ $items->income_id }}" class="form-label">Customer Name</label>
                                                <input type="text" class="form-control" id="customer_name{{ $items->income_id }}" name="customer_name" value="{{ $items->customer_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="project_name{{ $items->income_id }}" class="form-label">Project Name</label>
                                                <input type="text" class="form-control" id="project_name{{ $items->income_id }}" name="project_name" value="{{ $items->project_name }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="amount{{ $items->income_id }}" class="form-label">Amount</label>
                                                <input type="number" class="form-control" id="amount{{ $items->income_id }}" name="amount" value="{{ $items->amount }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date{{ $items->income_id }}" class="form-label text-capitalize">Date</label>
                                                <input type="date" class="form-control" id="date{{ $items->income_id }}" name="date" value="{{ $items->date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="payment_method{{ $items->id }}" class="form-label">Payment Method</label>
                                                <select class="form-select" id="payment_method{{ $items->id }}" name="payment_method" required>
                                                    <option value="cash" {{ $items->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                                    <option value="bank transfer" {{ $items->payment_method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                                    <option value="credit card" {{ $items->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                                    <option value="e-wallet" {{ $items->payment_method == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
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
                {{ $finance->links('pagination::bootstrap-5') }}
            </div>
        </div>

    <!-- Add finance Modal -->
    <div class="modal fade" id="addFinanceModal" tabindex="-1" aria-labelledby="addFinanceModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFinanceModalLabel">Add New Income</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('finance.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="project_name" name="customer_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="project_name" class="form-label">Project Name</label>
                            <input type="text" class="form-control" id="project_name" name="project_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label text-capitalize">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="cash">Cash</option>
                                <option value="bank transfer">Bank Transfer</option>
                                <option value="credit card">Credit Card</option>
                                <option value="e-wallet">E-Wallet</option>
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
    function confirmDelete(income_id) {
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
            document.getElementById('delete-form-' + income_id).submit();
        }
    });
}
</script>