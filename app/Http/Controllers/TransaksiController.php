<?php

namespace App\Http\Controllers;

use App\Models\transaksiModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Sales Transactions',
            'list' => ['Home', 'Sales Transactions']
        ];
        $activeMenu = 'sales';  // Mengatur activeMenu untuk menu transaksi
        $transaksi = transaksiModel::with('user')->orderBy('penjualan_tanggal', 'desc')->get();
    
        // Kirim data ke view
        return view('sales.index', compact('transaksi', 'breadcrumb', 'activeMenu'));
    }
    

    public function show($id)
    {
        $transaksi = transaksiModel::with('user')->orderBy('penjualan_tanggal', 'desc')->get();

        
        return view('sales.index',compact('transaksi'));
    }

    public function create()
{   $breadcrumb = (object)[
    'title' => 'Add New Transaction',
    'list' => ['Home', 'Sales Transactions', 'Add']
    ];
    $activeMenu = 'sales'; // kasih nilai sesuai menu aktif
    $users = UserModel::all();

    return view('sales.create', compact('users', 'activeMenu', 'breadcrumb'));
}

    

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:m_user,user_id',
            'pembeli' => 'required|string|max:50',
            'penjualan_kode' => 'required|string|max:20|unique:t_penjualan,penjualan_kode',
            'penjualan_tanggal' => 'required|date',
        ]);

        // Simpan transaksi baru
        transaksiModel::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function show_ajax(string $id)
    {
        $transaksi = transaksiModel::find($id);
        return view('barang.show_ajax', compact('barang'));
    }
}

