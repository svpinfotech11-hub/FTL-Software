@extends('admin.partials.app')

@section('main-content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0 text-success">Ledger List</h3>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('ledgers.create') }}" class="btn btn-success float-sm-end">
                        + Create Ledger
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card border-success shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Ledgers</h5>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover">
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
                            @forelse($ledgers as $ledger)
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
                                    <td>
                                        <a href="{{ route('ledgers.edit', $ledger->id) }}"
                                           class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ route('ledgers.destroy', $ledger->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">
                                        No ledgers found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $ledgers->links() }}
                </div>
            </div>

        </div>
    </div>
</main>

@endsection
