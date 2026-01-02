@include('admin.partials.header')
      <!--begin::Header-->
     @include('admin.partials.navbar')
      <!--end::Header-->
      <!--begin::Sidebar-->
     @include('admin.partials.sidebar')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
       @yield('main-content')
      </main>

      @include('footer')
      