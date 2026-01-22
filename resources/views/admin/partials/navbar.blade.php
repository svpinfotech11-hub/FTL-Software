  <style>
      .btn-sm-text {
          font-size: 12px;
          padding: 6px 8px;
          line-height: 1.2;
      }
  </style>
  <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                      <i class="bi bi-list"></i>
                  </a>
              </li>
              <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
              <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
              <!--begin::Navbar Search-->
              
            
              <!--end::Notifications Dropdown Menu-->
              <!--begin::Fullscreen Toggle-->
              <li class="nav-item">
                  <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                      <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                      <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                  </a>
              </li>
              <!--end::Fullscreen Toggle-->
              <!--begin::User Menu Dropdown-->
              @php
                  $user = Auth::user();
                  $profileImage = $user->profile_image
                      ? asset('storage/profile_images/' . $user->profile_image)
                      : asset('assets/assets/img/user2-160x160.jpg');

                  $designation = match ($user->role) {
                      'superadmin' => 'Super Admin',
                      'admin' => 'Administrator',
                      default => 'User',
                  };

                 $logoutRoute = match ($user->role) {
                     'superadmin' => 'superadmin.logout',
                     default => 'logout',
                 };
             @endphp
                  <!-- $logoutRoute = match ($user->role) {
                      'superadmin' => 'superadmin.logout',
                      'admin' => 'admin.logout',
                      default => 'logout',
                  }; -->
              <!-- @endphp -->

              <li class="nav-item dropdown user-menu">
                  <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                      <img src="{{ $profileImage }}" class="user-image rounded-circle shadow" alt="User Image" />
                      <span class="d-none d-md-inline">{{ $user->name }}</span>
                  </a>

                  <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                      <!-- User Image -->
                      <li class="user-header text-bg-primary">
                          <img src="{{ $profileImage }}" class="rounded-circle shadow" alt="User Image" />
                          <p>
                              {{ $user->name }} - {{ $designation }}
                              <small>
                                  Member since {{ $user->created_at->format('M Y') }}
                              </small>
                          </p>
                      </li>

                      <!-- Footer -->
                      <li class="user-footer d-flex justify-content-between align-items-center gap-2">

                          <a href="{{ route('profile.edit') }}"
                              class="btn btn-default btn-flat flex-fill text-center btn-sm-text">
                              Profile
                          </a>

                          <a href="{{ route('profile.password') }}"
                              class="btn btn-default btn-flat flex-fill text-center btn-sm-text">
                              Change Password
                          </a>

                          <form action="{{ route($logoutRoute) }}" method="POST" class="m-0 flex-fill">
                              @csrf
                              <button type="submit" class="btn btn-default btn-flat text-danger w-100 btn-sm-text">
                                  Sign out
                              </button>
                          </form>


                      </li>

                  </ul>
              </li>


              <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
  </nav>
