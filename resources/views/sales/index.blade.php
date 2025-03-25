@extends('layout.template')

@section('content')
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-blue-900 mb-6">Sales Transactions</h1>

    <!-- Tombol Tambah Transaksi -->
    <a href="{{ route('transaksi.create') }}" class="bg-blue-500 text-black px-4 py-2 rounded-lg">Add New Transaction</a>

    <div class="mt-6">
        <table class="w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-blue-100">
                    <th class="border p-3">Transaction Code</th>
                    <th class="border p-3">Buyer</th>
                    <th class="border p-3">Date</th>
                    <th class="border p-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $trx)
                <tr class="text-center bg-white">
                    <td class="border p-3">{{ $trx->penjualan_kode }}</td>
                    <td class="border p-3">{{ $trx->pembeli }}</td>
                    <td class="border p-3">{{ $trx->penjualan_tanggal }}</td>
                    <td class="border p-3 space-x-2">
                        <a href="{{ route('transaksi.show', $trx->penjualan_id) }}" class="text-blue-500">View</a>
                        <a href="{{ route('transaksi.edit', $trx->penjualan_id) }}" class="text-yellow-500">Edit</a>
                        <form action="{{ route('transaksi.destroy', $trx->penjualan_id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
