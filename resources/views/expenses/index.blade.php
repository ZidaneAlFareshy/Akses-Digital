@extends('layouts.app')

@section('content')
        <h3 class="fw-semibold">Expenses List</h3>
        <div class="d-flex justify-content-end">
            <button class="btn text-white" style="background-color: #e65f2b;" data-bs-toggle="modal" data-bs-target="#addExpenseModal">Add New Expense</button>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
            <form action="{{ route('expenses.index') }}" method="GET" class="d-flex gap-2 flex-grow-1">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input 
                        type="text" 
                        class="form-control border-start-0 ps-0" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search category, amount, description..."
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
                            <a href="{{ route('expenses.index') }}" class="btn btn-light">Reset</a>
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
                        <th>Expense ID</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->expense_id }}</td>
                            <td class="text-capitalize">{{ $expense->category }}</td>
                            <td>{{ $expense->amount }}</td>
                            <td>{{ $expense->date ? \Carbon\Carbon::parse($expense->date)->format('d-m-Y') : '-' }}</td>
                            <td>{{ $expense->description }}</td>
                            <td>
                                <button class="btn text-white btn-sm" style="background-color: #e65f2b;"  data-bs-toggle="modal" data-bs-target="#editexpenseModal{{ $expense->expense_id }}">Edit</button>
                                <form id="delete-form-{{ $expense->expense_id }}" action="{{ route('expenses.destroy', $expense->expense_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $expense->expense_id }})">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <!-- Edit expense Modal -->
                        <div class="modal fade" id="editexpenseModal{{ $expense->expense_id }}" tabindex="-1" aria-labelledby="editexpenseModalLabel{{ $expense->expense_id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editexpenseModalLabel{{ $expense->expense_id }}">Edit Expense</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('expenses.update', $expense->expense_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="category{{ $expense->expense_id }}" class="form-label">Category</label>
                                                <input type="text" class="form-control" id="category{{ $expense->expense_id }}" name="category" value="{{ $expense->category }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="amount{{ $expense->expense_id }}" class="form-label">Amount</label>
                                                <input type="number" class="form-control" id="amount{{ $expense->expense_id }}" name="amount" value="{{ $expense->amount }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="date{{ $expense->expense_id }}" class="form-label">Date</label>
                                                <input type="date" class="form-control" id="date{{ $expense->expense_id }}" name="date" value="{{ $expense->date }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description{{ $expense->expense_id }}" class="form-label">Description</label>
                                                <input type="text" class="form-control" id="description{{ $expense->expense_id }}" name="description" value="{{ $expense->description }}">
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
                {{ $expenses->links('pagination::bootstrap-5') }}
            </div>
        </div>

    <!-- Add expense Modal -->
    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExpenseModalLabel">Add New expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('expenses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" name="category" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label text-capitalize">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description"></textarea>
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
    function confirmDelete(expense_id) {
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
            document.getElementById('delete-form-' + expense_id).submit();
        }
    });
}
</script>