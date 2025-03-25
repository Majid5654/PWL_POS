<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class LevelController extends Controller
{
    public function index(){

        //DB::insert('insert into m_level(level_kode,level_nama,created_at) values(?,?,?)',['CUS','pelanggan',now()]);
        //return 'Insert data baru berhasil';

        //$row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer' , 'CUS']);
        //return 'Update data berhasil . Jumlah data yang diupdate:' .$row. 'baris';

        //$row = DB::delete('delete from m_level where level_kode = ?' , ['CUS']);
        //return 'Delete data berhasil . Jumlah data yang dihapus:' .$row. 'baris';

        //$data = DB::select('select  * from m_level');
        //return view('level', ['data' => $data]);
        $breadcrumb = (object) [
            'title' => 'Level User',
            'list' => ['Home', 'Data Level']
        ];

        $page = (object) [
            'title' => 'Daftar Level yang terdaftar dalam sistem'
        ];
        $activeMenu = 'level';
        $levels = LevelModel::all();

        return view('level.index', compact('breadcrumb', 'page', 'activeMenu', 'levels'));

    }

    

public function list(Request $request)
    {
        $levels = LevelModel::select('level_id', 'level_kode', 'level_nama');
        if($request->level_id){
            $levels->where('level_id', $request->level_id);
            $levels->where('level_id', $request->level_id);
        }
        return DataTables::of($levels)

            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<button onclick="modalAction(\''.url('/level/' . $level->level_id .
                '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id .
                '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/level/' . $level->level_id .
                '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Level',
            'list' => ['Home', 'Data Level', 'Tambah Level']
        ];

        $page = (object) [
            'title' => 'Tambah Level Baru'
        ];

        $activeMenu = 'level';
        return view('level.create', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
            'level_nama' => 'required|string|max:100'
        ]);

        LevelModel::insert([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);
        return redirect('/level')->with('success', 'Level berhasil disimpan');
    }

    public function show(string $id)
    {
        $level = LevelModel::find($id);
        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Level'
        ];
        $activeMenu = 'level';
        return view('level.show', compact('level', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function edit(string $id)
    {
        $level = LevelModel::find($id);
        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Level'
        ];
        $activeMenu = 'level';
        return view('level.edit', compact('level', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'level_kode' => 'required|string|min:3|unique:m_level,level_kode,' . $id . ',level_id',
            'level_nama' => 'required|string|max:100'
        ]);

        $level = LevelModel::find($id);
        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        $level->update([
            'level_kode' => $request->level_kode,
            'level_nama' => $request->level_nama
        ]);
        return redirect('/level')->with('success', 'Level berhasil diubah');
    }

    public function destroy(string $id)
    {
        $level = LevelModel::find($id);
        if (!$level) {
            return redirect('/level')->with('error', 'Data level tidak ditemukan');
        }

        try {
            LevelModel::destroy($id);
            return redirect('/level')->with('success', 'Data level berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/level')->with('error', 'Data level gagal dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
        }
    }
    public function create_ajax()
    {

        $level = LevelModel::select('level_id','level_nama')->get();
        return view('level.create_ajax')
                        ->with('level',$level);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_kode' => 'required|string|min:3|unique:m_level,level_kode',
                'level_nama' => 'required|string|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()->messages()
                ]);
            }

            try {
                LevelModel::create($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan'
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menyimpan data. Kode level sudah digunakan atau terjadi kesalahan lain.'
                ]);
            }
        }

        return redirect('/level');
    }

    public function show_ajax(String $id)
    {
        $level = LevelModel::find($id);
        return view('level.show_ajax', compact('level'));
    }

    public function edit_ajax(String $id)
    {
        $level = LevelModel::find($id);
        return view('level.edit_ajax', compact('level'));
    }

    public function update_ajax(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'level_kode' => 'required|max:50',
        'level_nama' => 'required|max:100',
    ]);

    // Cari data level
    $level = LevelModel::find($id);
    if (!$level) {
        return response()->json(['status' => false, 'message' => 'Data tidak ditemukan!']);
    }

    // Update data
    $level->update([
        'level_kode' => $request->level_kode,
        'level_nama' => $request->level_nama,
    ]);
    return redirect('/level');
    
}

    public function confirm_ajax(String $id)
    {
        $level = LevelModel::find($id);
        return view('level.confirm_ajax', compact('level'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $level = LevelModel::find($id);
            if ($level) {
                try {
                    LevelModel::destroy($id);
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


