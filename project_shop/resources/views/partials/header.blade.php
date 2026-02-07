<div class="hero_area @if(!Request::is('/')) innerpage @endif">
  <!-- header section starts -->
  <header class="header_section">
    <nav class="navbar navbar-expand-lg custom_nav-container">
      <a class="navbar-brand" href="{{ route('home') }}">
        <span>Giftos</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class=""></span>
      </button>

      <div class="collapse navbar-collapse @if(!Request::is('/')) innerpage_navbar @endif" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('home') }}">
              Home @if(Request::is('/')) <span class="sr-only">(current)</span> @endif
            </a>
          </li>
          <li class="nav-item {{ Request::is('shop') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('shop') }}">Shop</a>
          </li>
          <li class="nav-item {{ Request::is('why') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('why') }}">Why Us</a>
          </li>
          <li class="nav-item {{ Request::is('testimonial') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('testimonial') }}">Testimonial</a>
          </li>
          <li class="nav-item {{ Request::is('contact') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('contact') }}">Contact Us</a>
          </li>
          @auth
          <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          @endauth
        </ul>
        <div class="user_option">
          @auth
            <a href="{{ route('dashboard') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>{{ Auth::user()->name }}</span>
            </a>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
              @csrf
              <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                <span>Logout</span>
              </button>
            </form>
          @else
            <a href="{{ route('index') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Login</span>
            </a>
          @endauth
          <a href="">
            <i class="fa fa-shopping-bag" aria-hidden="true"></i>
          </a>
          <form class="form-inline">
            <button class="btn nav_search-btn" type="submit">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </form>
        </div>
      </div>
    </nav>
  </header>
  <!-- end header section -->

  @yield('hero')
</div>
<!-- end hero area -->
