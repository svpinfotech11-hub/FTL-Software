 @extends('admin.partials.app')
 @section('main-content')


     <!--begin::App Main-->
     <main class="app-main">
         <!--begin::App Content Header-->
         <div class="app-content-header">
             <!--begin::Container-->
             <div class="container-fluid">
                 <!--begin::Row-->
                 <div class="row">
                     <div class="col-sm-6">
                         <h3 class="mb-0">Create New</h3>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-end">
                             <li class="breadcrumb-item"><a href="#">Home</a></li>
                             <li class="breadcrumb-item active" aria-current="page">Create New</li>
                         </ol>
                     </div>
                 </div>
                 <!--end::Row-->
             </div>
             <!--end::Container-->
         </div>
         <!--end::App Content Header-->
         <!--begin::App Content-->
         <div class="app-content">
             <!--begin::Container-->
             <div class="container-fluid">
                 <!--begin::Row-->
                 <div class="row g-4">
                     <!--begin::Col-->

                     <!--end::Col-->
                     <!--begin::Col-->
                     <div class="col-md-12">
                         <!--begin::Quick Example-->
                         <div class="card card-primary card-outline mb-4">
                             <!--begin::Header-->
                             <div class="card-header">
                                 <div class="card-title">Quick Example</div>
                             </div>
                             <!--end::Header-->
                             <!--begin::Form-->

                             @if ($errors->any())
                                 <div class="alert alert-danger">
                                     <ul>
                                         @foreach ($errors->all() as $error)
                                             <li>{{ $error }}</li>
                                         @endforeach
                                     </ul>
                                 </div>
                             @endif
                             @if (session('success'))
                                 <h1>{{ session('success') }}</h1>
                             @endif
                             <form method="POST" action="{{ route('user.store.submit') }}">
                                 @csrf

                                 <!--begin::Body-->
                                 <div class="card-body">

                                     <div class="row g-3">

                                         <!-- Name -->
                                         <div class="col-md-4">
                                             <label class="form-label">Full Name</label>
                                             <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                                 placeholder="Enter full name" required />
                                         </div>

                                         <!-- Email -->
                                         <div class="col-md-4">
                                             <label class="form-label">Email Address</label>
                                             <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                                 placeholder="Enter email" required />
                                         </div>

                                         <!-- Phone -->
                                         <div class="col-md-4">
                                             <label class="form-label">Phone Number</label>
                                             <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                                 placeholder="Enter phone number" required />
                                         </div>

                                     </div>

                                     <div class="row g-3 mt-3">

                                         <!-- Branch -->
                                         <div class="col-md-4">
                                             <label class="form-label">Branch</label>
                                             <select name="branch_id" class="form-select" required>
                                                 <option value="">Select Branch</option>
                                                 @foreach ($branches as $branch)
                                                     <option value="{{ $branch->id }}">{{ $branch->branch_name }}
                                                         ({{ $branch->branch_code }})</option>
                                                 @endforeach
                                             </select>
                                         </div>

                                         <!-- Status -->
                                         <div class="col-md-4">
                                             <label class="form-label">Status</label>
                                             <select name="status" class="form-select" required>
                                                 <option value="active">Active</option>
                                                 <option value="inactive">Inactive</option>
                                             </select>
                                         </div>

                                     </div>

                                 </div>
                                 <!--end::Body-->

                                 <!--begin::Footer-->
                                 <div class="card-footer text-end mt-3">
                                     <!-- Back Button -->
                                     <a href="{{ route('user.index') }}" class="btn btn-outline-secondary me-2">
                                         <i class="bi bi-arrow-left"></i> Back
                                     </a>

                                     <!-- Submit Button -->
                                     <button type="submit" class="btn btn-primary">
                                         <i class="bi bi-check-lg"></i> Create User
                                     </button>
                                 </div>

                                 <!--end::Footer-->
                             </form>
                             <!--end::Form-->
                         </div>
                         <!--end::Quick Example-->

                     </div>

                 </div>
                 <!--end::Row-->
             </div>
             <!--end::Container-->
         </div>
         <!--end::App Content-->
     </main>
     <!--end::App Main-->

 @endsection
