@extends('layout.template')

@section('content')
<a href="{{ url('/transaksi') }}" class="nav-link {{ ($activeMenu == 'sales') ? 'active' : '' }}">
    <i class="nav-icon fas fa-cash-register"></i>
    <p>Sales Transactions</p>
</a>
<div class="container mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-blue-900 mb-6">Add New Transaction</h1>

    <form action="{{ route('transaksi.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Buyer</label>
            <input type="text" name="pembeli" class="w-full px-3 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Transaction Code</label>
            <input type="text" name="penjualan_kode" class="w-full px-3 py-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Date</label>
            <input type="datetime-local" name="penjualan_tanggal" class="w-full px-3 py-2 border rounded-lg">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Save</button>
    </form>
</div>
@endsection
