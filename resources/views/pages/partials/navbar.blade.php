<div class="site-wrap">

  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <header class="site-navbar py-3" role="banner">

    <div class="container">
      <div class="row align-items-center">

        <div class="col-11 col-xl-2">
          <h1 class="mb-0"><a href="index.html" class="text-white h2 mb-0">Logistics</a></h1>
        </div>
        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">

            <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
              <li class="active"><a href="{{ url('/') }}">Home</a></li>
              <li><a href="{{ url('/about') }}">About Us</a></li>
              <li class="has-children">
                <a href="{{ url('/services') }}">Services</a>
                <ul class="dropdown">
                  <li><a href="#">Air Freight</a></li>
                  <li><a href="#">Ocean Freight</a></li>
                  <li><a href="#">Ground Shipping</a></li>
                  <li><a href="#">Warehousing</a></li>
                  <li><a href="#">Storage</a></li>
                </ul>
              </li>
              <li><a href="{{ url('/industries') }}">Industries</a></li>
              <li><a href="{{ url('/blog') }}">Blog</a></li>
              <li><a href="{{ url('/contact') }}">Contact</a></li>


              {{-- User Profile Dropdown --}}
              @auth
              <li class="has-children">
                <a href="#">
                  <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown">

                  @auth
                  <li>
                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                  </li>

                  <li>
                    <a href="">Profile</a>
                  </li>

                  <li>
                    <a href="{{ route('logout') }}"
                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                  </li>
                  @endauth

                  @guest
                  <li>
                    <a href="{{ route('login') }}">Login</a>
                  </li>
                  <li>
                    <a href="{{ route('user.register') }}">Register</a>
                  </li>
                  @endguest

                </ul>

              </li>
              @else
              <li><a href="{{ route('login') }}">Login</a></li>
              @endauth
            </ul>
          </nav>

        </div>


        <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

      </div>

    </div>
</div>

</header>