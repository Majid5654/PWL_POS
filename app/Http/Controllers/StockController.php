<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockRequest;
use App\Models\BarangModel;
use App\Models\Item;
use App\Models\Stock;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class StockController extends Controller
{

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $stocks = Stock::with(['barang', 'user'])->select('t_stok.*');

            return DataTables::of($stocks)
                ->addColumn('barang_nama', function ($stock) {
                    return $stock->barang ? $stock->barang->barang_nama : 'Data Tidak Ada';
                })
                ->addColumn('user_nama', function ($stock) {
                    return $stock->user ? $stock->user->nama : 'Data Tidak Ada';
                })
                ->rawColumns(['barang_nama', 'user_nama']) 
                ->make(true);
        }

        return view('stok.index'); 
    }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Stock Management',
            'list' => ['Home', 'Stock']
        ];

        $page = (object) [
            'title' => 'Daftar Stok yang Tersedia'
        ];

        $activeMenu = 'stock';
        $stocks = Stock::with(['barang', 'user'])->get();
        $stocks = Stock::with('user')->get();



       // dd($stocks);

        return view('stock.index', compact('breadcrumb', 'page', 'activeMenu', 'stocks'));
    }
    public function create()
    {
    
        $barang = BarangModel::all(); // Ambil semua barang dari tabel m_barang
        $users = UserModel::all(); // Ambil semua pengguna dari tabel users
        return view('stock.create_ajax',compact('barang','users'));
    }

    public function fetch()
    {
        $stoks = Stock::all();
        return response()->json(['stoks' => $stoks]);
    }

    public function storePage(Request $request)
    {
        // Validasi data input
        $validator = Validator::make($request->all(), [
            'barang_id' => 'required|exists:m_barang,barang_id', // Pastikan barang_id ada di tabel m_barang
            'user_id' => 'required|exists:users,id', // Pastikan user_id ada di tabel users
            'stok_jumlah' => 'required|integer|min:1', // Pastikan jumlah stok adalah angka positif
        ]);
    
        // Jika validasi gagal, kirim respon error dengan status 422 (Unprocessable Entity)
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal. Mohon periksa kembali input Anda.',
                'errors' => $validator->errors(),
            ], 422);
        }
    
        try {
            // Simpan data stok barang
            $stock = Stock::create([
                'barang_id' => $request->barang_id,
                'user_id' => $request->user_id,
                //'stok_tanggal' => Carbon::now(), // Menyimpan tanggal stok saat ini
                'stok_jumlah' => $request->stok_jumlah
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Stok Barang berhasil ditambahkan!',
                'data' => $stock
            ], 201); // Status 201: Created
    
        } catch (\Exception $e) {
            // Tangkap jika ada kesalahan dalam penyimpanan data
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
                'error' => $e->getMessage()
            ], 500); // Status 500: Internal Server Error
        }
    }
    

    public function update(Request $request, $id)
    {
        $stok = Stock::find($id);
        $stok->update($request->all());
        return response()->json(['message' => 'Data berhasil diperbarui!', 'stok' => $stok]);
    }

    public function destroy($id)
    {
        Stock::destroy($id);
        return response()->json(['message' => 'Data berhasil dihapus!']);
    }
    public function edit (String $id)
    {
        $barang = BarangModel::all(); // Ambil semua barang dari tabel m_barang
        $users = UserModel::all(); // Ambil semua pengguna dari tabel users
        $stok = Stock::find($id);
        $activeMenu = '';
        $breadcrumb = (object) [
            'title' => 'Stock Management',
            'list' => ['Home', 'Stock']
        ];
        return view('stock.edit_ajax', compact('barang', 'users', 'stok','activeMenu','breadcrumb'));
    }

    public function confirm_ajax(String $id)
    {
        $stok = Stock::find($id);
        return view('level.confirm_ajax', compact('level'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $stok = Stock::find($id);
            if ($stok) {
                try {
                    $stok::destroy($id);
                    return response()->json([
                        'status' => true,
                        'message' => 'Data berhasil dihapus'
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Data gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }


    
}
