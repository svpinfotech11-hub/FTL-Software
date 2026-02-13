 @extends('admin.partials.app')
 @section('main-content')
     <main class="app-main">
         <div class="app-content-header">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-sm-6">
                         <h3 class="mb-0 text-success">Freight Challan List</h3>
                     </div>
                     <div class="col-sm-6">
                         <a href="{{ route('freight-challan.create') }}" class="btn btn-success float-sm-end">
                             + Create Freight Challan
                         </a>
                     </div>
                 </div>
             </div>
         </div>

         <div class="app-content">
             <div class="container-fluid">

                 @if (session('success'))
                     <div class="alert alert-success">{{ session('success') }}</div>
                 @endif

                 <div class="card border-success shadow-sm">
                     <div class="card-header bg-success text-white">
                         <h5 class="mb-0">Freight Challans</h5>
                     </div>

                     <div class="card-body table-responsive">
                         <table class="table table-bordered table-hover datatable">
                             <thead class="table-light">
                                 <tr>
                                     <th>ID</th>
                                     <th>Challan No</th>
                                     <th>Driver</th>
                                     <th>Vehicle</th>
                                     <th>Grand Total</th>
                                     <th width="150">Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($challans as $c)
                                     <tr>
                                         <td>{{ $c->id }}</td>
                                         <td>{{ $c->challan_no }}</td>
                                         <td>{{ $c->driver->name ?? '' }}</td>
                                         <td>{{ $c->vehicle_no }}</td>
                                         <td>{{ $c->grand_total }}</td>
                                         <td>
                                             <a href="{{ route('freight-challan.edit', $c->id) }}"
                                                 class="btn btn-warning btn-sm">
                                                 <i class="bi bi-pencil"></i>
                                             </a>
                                             <form action="{{ route('freight-challan.destroy', $c->id) }}" method="POST"
                                                 style="display:inline;">
                                                 @csrf @method('DELETE')
                                                 <button class="btn btn-danger btn-sm">
                                                     <i class="bi bi-trash"></i>
                                                 </button>
                                             </form>
                                         </td>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </main>
 @endsection
