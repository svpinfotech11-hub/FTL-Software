 @extends('admin.partials.app')
 @section('main-content')
     <main class="app-main">
         <div class="app-content-header">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-sm-6">
                         <h3 class="mb-0 text-secondary" style="font-weight: bold;">GST Billing</h3>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-end">
                             <li class="breadcrumb-item"><a href="{{ route('gst-billing.index') }}">Home</a></li>
                             <li class="breadcrumb-item active">GST Billing</li>
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
                         <div class="card-title">Invoice List</div>
                         <a href="{{ route('gst-billing.create') }}" class="btn btn-primary btn-sm"><i
                                 class="bi bi-plus-lg"></i> Create Invoice</a>
                     </div>

                     <div class="card-body table-responsive">
                         <table class="table align-middle table-hover datatable">
                             <thead class="table-light">
                                 <tr>
                                     <th>ID</th>
                                     <th>Invoice No</th>
                                     <th>Date</th>
                                     <th>Consignor</th>
                                     <th>Consignee</th>
                                     <th>Grand Total</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 @foreach ($billings as $bill)
                                     <tr>
                                         <td>{{ $bill->id }}</td>
                                         <td>{{ $bill->invoice_no }}</td>
                                         <td>{{ $bill->invoice_date }}</td>
                                         <td>{{ $bill->consigner->name ?? '' }}</td>
                                         <td>{{ $bill->consignee->name ?? '' }}</td>
                                         <td>{{ $bill->grand_total }}</td>
                                           <td class="text-center">
                                            <a href="{{ route('gst-billing.edit', $bill->id) }}"
                                                class="btn btn-sm btn-outline-warning me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('gst-billing.destroy', $bill->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure to delete this gst billing?')">
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
