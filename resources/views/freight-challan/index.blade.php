 @extends('admin.partials.app')
 @section('main-content')
     <main class="app-main">
         <div class="app-content-header">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-sm-6">
                         <h3 class="mb-0">Freight Challan</h3>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-end">
                             <li class="breadcrumb-item"><a href="{{ route('freight-challan.index') }}">Home</a></li>
                             <li class="breadcrumb-item active">Create Freight Challan</li>
                         </ol>
                     </div>
                 </div>
             </div>
         </div>

         <div class="app-content">
             <div class="container-fluid">

                 @if (session('success'))
                     <div class="alert alert-success">{{ session('success') }}</div>
                 @endif
                 <div class="card card-primary card-outline mb-4">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <div class="card-title">Freight Challans List</div>
                         <a href="{{ route('freight-challan.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Freight
                             Challan</a>
                     </div>

                     <div class="card-body table-responsive">
                         <table class="table align-middle table-hover datatable">
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
                                         <td class="text-center">
                                             <a href="{{ route('freight-challan.edit', $c->id) }}"
                                                 class="btn btn-sm btn-outline-warning me-1">
                                                 <i class="bi bi-pencil-square"></i>
                                             </a>

                                             <form action="{{ route('freight-challan.destroy', $c->id) }}"
                                                 method="POST" class="d-inline-block">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit" class="btn btn-sm btn-outline-danger"
                                                     onclick="return confirm('Are you sure to delete this freight challan?')">
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
