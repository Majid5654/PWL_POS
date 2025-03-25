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
            'title' => 'Kategori',
            'list' => ['Home', 'Data Kategori']
        ];
        $activeMenu = 'transaksi';
        $transaksi = transaksiModel::with('user')->orderBy('penjualan_tanggal', 'desc')->get();

        // Kirim data ke view
        return view('sales.index', compact('transaksi', 'breadcrumb', 'activeMenu'));
        
    }

    public function show($id)
    {
        $transaksi = transaksiModel::with('user')->orderBy('penjualan_tanggal', 'desc')->get();

        // Kirim data ke view
        return view('sales.index', compact('transaksi'));
    }

    public function create()
    {
        $users = UserModel::all();
        return view('sales.create', compact('users'));
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
}

