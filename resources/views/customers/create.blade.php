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
                     <h3 class="mb-0">Create Customer</h3>
                 </div>
                 <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-end">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Create Customer</li>
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


                         @if(session('success'))
                         <h1>{{session('success')}}</h1>
                         @endif


                         <form method="POST" action="{{ route('customers.store') }}">
                             @csrf

                             <!--begin::Body-->
                             <div class="card-body">

                                 <div class="row g-3">

                                     <!-- Name -->
                                     <div class="col-md-4">
                                         <label class="form-label">Full Name</label>
                                         <input
                                             type="text"
                                             name="name"
                                             class="form-control"
                                             placeholder="Enter full name"
                                             required />
                                     </div>

                                     <!-- Email -->
                                     <div class="col-md-4">
                                         <label class="form-label">Email Address</label>
                                         <input
                                             type="email"
                                             name="email"
                                             class="form-control"
                                             placeholder="Enter email"
                                             required />
                                     </div>

                                     <!-- Phone -->
                                     <div class="col-md-4">
                                         <label class="form-label">Phone Number</label>
                                         <input
                                             type="text"
                                             name="phone"
                                             class="form-control"
                                             placeholder="Enter phone number"
                                             maxlength="10"
                                             pattern="\d{10}"
                                             title="Phone number must be 10 digits"
                                             required />
                                     </div>

                                 </div>

                                 <div class="row g-3 mt-3">
                                     <!-- Role -->
                                     <div class="col-md-4">
                                         <label class="form-label">User Role</label>
                                         <select name="role" class="form-select" required>
                                             <option value="">Select Role</option>
                                             <option value="super_admin">Super Admin</option>
                                             <option value="branch_manager">Branch Manager</option>
                                             <option value="booking_executive">Booking Executive</option>
                                             <option value="accounts_user">Accounts User</option>
                                             <option value="fleet_manager">Fleet Manager</option>
                                             <option value="vendor_manager">Vendor Manager</option>
                                             <option value="viewer">Viewer / Reports Only</option>
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

                                 <!-- Customer Fields -->

                                 <div class="row g-3 mt-4">

                                     <div class="col-md-4">
                                         <label class="form-label">Customer Code</label>
                                         <input type="text" name="customer_code" class="form-control" placeholder="Enter customer code" />
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">Customer Name</label>
                                         <input type="text" name="customer_name" class="form-control" placeholder="Enter customer name" />
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">Contact Person</label>
                                         <input type="text" name="contact_person" class="form-control" placeholder="Enter contact person" />
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">Address</label>
                                         <textarea name="address" class="form-control" placeholder="Enter address"></textarea>
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">Pincode</label>
                                         <input type="number" id="pincode" name="pincode" class="form-control" placeholder="Enter pincode" maxlength="6" />
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">State</label>
                                         <input type="text" name="state" id="state" class="form-control" placeholder="State will be auto-filled" readonly />
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">City</label>
                                         <input type="text" name="city" id="city" class="form-control" placeholder="City will be auto-filled" readonly />
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">GST Number</label>
                                         <input type="text" name="gst_no" class="form-control" placeholder="Enter GST number" />
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">GST Charges</label>
                                         <select name="gst_charges" class="form-select">
                                             <option value="1">Yes</option>
                                             <option value="0" selected>No</option>
                                         </select>
                                     </div>

                                     <div class="col-md-4">
                                         <label class="form-label">Credit Days</label>
                                         <input type="number" name="credit_days" class="form-control" placeholder="Enter credit days" min="0" />
                                     </div>

                                 </div>

                                 <!-- Hidden user_id -->
                                 <input type="hidden" name="user_id" value="{{ auth()->id() }}" />

                             </div>
                             <!--end::Body-->

                             <!--begin::Footer-->
                             <div class="card-footer text-end mt-3">
                                 <!-- Back Button -->
                                 <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary me-2">
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

 <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 <script>
     $('#pincode').on('keyup', function() {
         let pincode = $(this).val();

         if (pincode.length === 6) {
             $.get('/get-location/' + pincode, function(res) {
                 console.log(res)
                 $('#state').val(res.state);
                 $('#city').val(res.city);
             }).fail(function() {
                 alert('Invalid Pincode');
             });
         }
     });
 </script>

 @endsection