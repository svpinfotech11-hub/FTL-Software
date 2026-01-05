@extends('admin.partials.app')

@section('main-content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Domestic Shipment</h4>
            <div>
                <a href="{{ route('domestic.shipment.create') }}" class="btn btn-primary btn-sm">
                    Add Domestic Shipment
                </a>
                <button class="btn btn-dark btn-sm">Print Selected Shipment</button>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body row g-2">

                <div class="col-md-2">
                    <label>Courier</label>
                    <select class="form-control">
                        <option>ALL</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Mode</label>
                    <select class="form-control">
                        <option>ALL</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Filter</label>
                    <select class="form-control">
                        <option>Select Filter</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Filter Value</label>
                    <input type="text" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>Customer</label>
                    <select class="form-control">
                        <option>Select Customer</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label>From Date</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-2">
                    <label>To Date</label>
                    <input type="date" class="form-control">
                </div>

                <div class="col-md-4 d-flex align-items-end gap-2">
                    <button class="btn btn-primary">Filter</button>
                    <button class="btn btn-dark">Download Report</button>
                    <button class="btn btn-info text-white">Reset</button>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Sr.No</th>
                            <th>AWB No</th>
                            <th>Sender</th>
                            <th>Receiver</th>
                            <th>Receiver City</th>
                            <th>Pincode</th>
                            <th>Forwarder</th>
                            <th>Booking Date</th>
                            <th>Mode</th>
                            <th>Pay Mode</th>
                            <th>Amount</th>
                            <th>Weight</th>
                            <th>QTY</th>
                            <th>PKT</th>
                            <th>Invoice No</th>
                            <th>Invoice Amount</th>
                            <th>Invoice Date</th>
                            <th>Branch</th>
                            <th>User</th>
                            <th>Eway No</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($shipments as $key => $row)
                            <tr>
                                <td>
                                    <input type="checkbox" name="ids[]" value="{{ $row->id }}">
                                </td>

                                <td>{{ $key + 1 }}</td>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $row->airway_no }}
                                    </span>
                                </td>
                                <td>{{ $row->consigner_name }}</td>
                                <td>{{ $row->consignee_name }}</td>
                                <td>{{ $row->consignee_city }}</td>
                                <td>{{ $row->consignee_pincode }}</td>
                                <td>{{ $row->courier ?? 'SELF' }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($row->shipment_date)->format('d-m-Y') }}
                                </td>
                                <td>{{ $row->delivery_type ?? '-' }}</td>
                                <td>{{ $row->bill_type }}</td>
                                <td>{{ number_format($row->grand_total, 2) }}</td>
                                <td>{{ $row->chargeable_weight }}</td>
                                <td>{{ $row->qty }}</td>
                                <td>{{ $row->pkt }}</td>
                                <td>{{ $row->invoice_no ?? '-' }}</td>
                                <td>{{ $row->sub_total }}</td>
                                <td>
                                    {{ $row->invoice_date ? \Carbon\Carbon::parse($row->invoice_date)->format('d-m-Y') : '-' }}
                                </td>
                                <td>{{ $row->branch_name ?? 'BHIWANDI HO' }}</td>
                                <td>{{ optional($row->user)->name ?? 'Admin' }}</td>
                                <td>{{ $row->eway_no ?? '-' }}</td>

                                <td>
                                    <div class="btn-group-vertical">
                                        <a href="{{ route('domestic.shipment.edit', $row->id) }}"
                                            class="btn btn-sm btn-warning" title="Edit">
                                            ✏️
                                        </a>

                                        <!-- Delete -->
                                        <form action="{{ route('domestic.shipment.destroy', $row->id) }}" method="POST"
                                            class="delete-shipment-form" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger delete-btn" title="Delete">
                                                🗑️
                                            </button>
                                        </form>
                                        <a href="{{ route('domestic.shipment.pod', $row->id) }}" target="_blank"
                                            class="btn btn-sm btn-danger" title="View POD">
                                            📄
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="22" class="text-center text-muted">
                                    No records found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const form = this.closest('.delete-shipment-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Deleted!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        @endif

    });
</script>
