 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
   <!--begin::Sidebar Brand-->
   <div class="sidebar-brand">
     <!--begin::Brand Link-->
     <a href="{{ Auth::check() && Auth::user()->role === 'superadmin'
        ? route('superadmin.dashboard')
        : route('user.dashboard') }}"
       class="brand-link">

       <!--begin::Brand Image-->
       <img
         src="{{ asset('assets/assets/img/AdminLTELogo.png') }}"
         alt="AdminLTE Logo"
         class="brand-image opacity-75 shadow" />
       <!--end::Brand Image-->
       <!--begin::Brand Text-->
       <span class="brand-text fw-light">AdminLTE 4</span>
       <!--end::Brand Text-->
     </a>
     <!--end::Brand Link-->
   </div>
   <!--end::Sidebar Brand-->
   <!--begin::Sidebar Wrapper-->
   <div class="sidebar-wrapper">
     <nav class="mt-2">
       <!--begin::Sidebar Menu-->
       <ul
         class="nav sidebar-menu flex-column"
         data-lte-toggle="treeview"
         role="navigation"
         aria-label="Main navigation"
         data-accordion="false"
         id="navigation">

         @auth
         {{-- Superadmin only menu --}}
         @if(Auth::user()->role === 'superadmin')
         
          <li class="nav-item menu-open">
           <a href="#" class="nav-link active">
             <i class="nav-icon bi bi-speedometer"></i>
             <p>
               Vendors
               <i class="nav-arrow bi bi-chevron-right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{ route('vendors.create') }}" class="nav-link active">
                 <i class="nav-icon bi bi-circle"></i>
                 <p>Add New</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{ route('vendors.index') }}" class="nav-link">
                 <i class="nav-icon bi bi-circle"></i>
                 <p>All Record</p>
               </a>
             </li>
           </ul>
         </li>
         @endif

         {{-- User only menu --}}
         @if(Auth::user()->role === 'user')
         <li class="nav-item menu-open">
           <a href="#" class="nav-link active">
             <i class="nav-icon bi bi-speedometer"></i>
             <p>
               Users
               <i class="nav-arrow bi bi-chevron-right"></i>
             </p>
           </a>
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{ route('user.create') }}" class="nav-link active">
                 <i class="nav-icon bi bi-circle"></i>
                 <p>Add New</p>
               </a>
             </li>
             <li class="nav-item">
               <a href="{{ route('user.index') }}" class="nav-link">
                 <i class="nav-icon bi bi-circle"></i>
                 <p>All Record</p>
               </a>
             </li>
           </ul>
         </li>


         @endif
         @endauth
       </ul>

       <!--end::Sidebar Menu-->
     </nav>
   </div>
   <!--end::Sidebar Wrapper-->
 </aside>