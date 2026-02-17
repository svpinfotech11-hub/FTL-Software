@extends('admin.partials.app')

@section('main-content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0 text-secondary" style="font-weight: bold;">Ledger</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('ledgers.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Ledger</li>
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
                        <div class="card-title">Ledger List</div>
                        <a href="{{ route('ledgers.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Add Ledger
                        </a>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table align-middle table-hover datatable">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Party Name</th>
                                    <th>Ledger Group</th>
                                    <th>GST No</th>
                                    <th>Mobile</th>
                                    <th>Opening Balance</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ledgers as $ledger)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ledger->party_name }}</td>
                                        <td>{{ $ledger->ledger_group }}</td>
                                        <td>{{ $ledger->gst_no }}</td>
                                        <td>{{ $ledger->mobile_no }}</td>
                                        <td>
                                            {{ $ledger->opening_bal }}
                                            <strong>{{ $ledger->opening_type }}</strong>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('ledgers.edit', $ledger->id) }}"
                                                class="btn btn-sm btn-outline-warning me-1">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            <form action="{{ route('ledgers.destroy', $ledger->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Are you sure to delete this ledger?')">
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
