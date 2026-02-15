<nav class="navbar">
    <h1>🛒 Shop System</h1>
    <div class="nav-links">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('product.index') }}" class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}">Products</a>
        <a href="{{ route('category.index') }}" class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}">Categories</a>
        <a href="{{ route('user.index') }}" class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">Users</a>
        <a href="{{ route('order.index') }}" class="nav-link {{ request()->routeIs('order.*') ? 'active' : '' }}">Orders</a>
        <a href="{{ route('dashboard.index') }}" class="nav-link {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">Dashboard</a>
    </div>
    <div class="user-info">
        <span>Welcome, <strong>{{ Session::get('user.name', 'Admin') }}</strong></span>
        <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 10px;">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>
