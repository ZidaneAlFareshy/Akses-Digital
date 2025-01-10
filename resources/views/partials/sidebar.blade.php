<div class="sidebar">
    <!-- Hamburger Menu -->
    {{-- <div class="hamburger">&#9776;</div> --}}
    <div class="user-info text-center">
        <img src="{{ asset('images/user.jpg') }}" alt="User Image">
        <div>
            <p class="text-white mb-0 fw-medium text-capitalize">{{ Auth::user()->name }}</p>
            <small class="text-white fw-light">Super Admin</small>
        </div>
    </div>

    <div class="nav-list fw-light mt-3">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-th-large"></i> Dashboard
        </a>
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Users
        </a>
        <a href="{{ route('staff.index') }}" class="{{ request()->routeIs('staff.*') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i> Staff
        </a>
        <a href="{{ route('customers.index') }}" class="{{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <i class="fas fa-user"></i> Customers
        </a>
        <a href="{{ route('orders.index') }}" class="{{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i> Orders
        </a>
        <a href="{{ route('projects.index') }}" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">
            <i class="fas fa-briefcase"></i> Projects
        </a>
        <a href="{{ route('tasks.index') }}" class="{{ request()->routeIs('tasks.*') ? 'active' : '' }}">
            <i class="fas fa-tasks"></i> Tasks
        </a>
        <a href="{{ route('finance.index') }}" class="{{ request()->routeIs('finance.*') ? 'active' : '' }}">
            <i class="fas fa-coins"></i> Finance
        </a>
        <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt"></i> Reports
        </a>
        <a href="{{ route('activity.index') }}" class="{{ request()->routeIs('activity.*') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Log Activity
        </a>
        <a href="{{ route('expenses.index') }}" class="{{ request()->routeIs('expenses.*') ? 'active' : '' }}">
            <i class="fas fa-wallet"></i> Expenses
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>