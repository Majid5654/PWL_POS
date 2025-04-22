@extends('layout.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Sales Transactions</h3>
            <div class="card-tools">
                <a href="/transaksi/create" class="btn btn-sm btn-primary mt-1">Add New Transaction</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover table-sm" id="table_transaksi">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Transaction Code</th>
                        <th>Buyer</th>
                        <th>Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksi as $index => $trx)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $trx->penjualan_kode }}</td>
                            <td>{{ $trx->pembeli }}</td>
                            <td>{{ $trx->penjualan_tanggal }}</td>
                            <td class="text-center">
                                <a href="/transaksi/{{ $trx->penjualan_id }}" class="btn btn-sm btn-info">View</a>
                                <a href="/transaksi/{{ $trx->penjualan_id }}/edit" class="btn btn-sm btn-warning">Edit</a>
                                <form action="/transaksi/{{ $trx->penjualan_id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $('#table_transaksi').DataTable({
                ordering: true,
                paging: true,
                info: true,
                searching: true,
            });
        });
    </script>
@endpush
