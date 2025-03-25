<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class UserController extends Controller
 {
//     public function index(){
//         $user = UserModel::with('level')->get();
//         return view('user',['data' => $user]);
//       }
// public function tambah(){
//     return view('user_tambah');
// }

// public function tambah_simpan(Request $request){

//     UserModel::create([
//         'username' => $request->username,
//         'nama' => $request->nama,
//         'password' => Hash :: make('$request->password'),
//         'level_id' => $request->level_id
//         ]);
        
//         return redirect('/user');
// }

// public function ubah($id){
//     $user = UserModel::find($id);
//     return view('user_ubah', ['data' => $user]);
// }

// public function ubah_simpan($id,Request $request){
//     $user = UserModel::find($id);

//     $user->username = $request->username;
//     $user->nama = $request->nama;
//     $user->password = Hash::make('$request->password');
//     $user->level_id = $request->level_id;
    
//     $user->save();
    
//     return redirect('/user');    
// }

// public function hapus($id){
//     $user = UserModel::find($id);
//     $user->delete();

//     return redirect('/user');
// }
public function index()
{
    $breadcrumb = (object) [
        'title' => 'Daftar User',
        'list' => ['Home', 'User']
    ];

    $page = (object) [
        'title' => 'Daftar User yang terdaftar di sistem'
    ];

    $activeMenu = 'user';

    $level = LevelModel::all();

    return view('user.index', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'level' => $level,
        'activeMenu' => $activeMenu
    ]);
}
    // Fetch user data in json form for datatables
    public function list(Request $request)
{
$users = UserModel::select('user_id', 'username', 'nama', 'level_id')
->with('level');
// Filter data user berdasarkan level_id
if ($request->level_id){
$users->where('level_id',$request->level_id);
}
return DataTables::of($users)
->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom:DT_RowIndex)
->addColumn('aksi', function ($user) { // menambahkan kolom aksi


    $btn = '<button onclick="modalAction(\''.url('/user/' . $user->user_id .
'/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
$btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id .
'/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
$btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id .
'/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button> ';
return $btn;
})
->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
->make(true);
}

    // Menampilkan halaman form tambah user
public function create()
{
    $breadcrumb = (object) [
        'title' => 'Tambah User',
        'list' => ['Home', 'User', 'Tambah']
    ];

    $page = (object) [
        'title' => 'Tambah user baru'
    ];

    $level = LevelModel::all(); // ambil data level untuk ditampilkan di form
    $activeMenu = 'user'; // set menu yang sedang aktif

    return view('user.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'level' => $level, 'activeMenu' => $activeMenu]);
}

// Menyimpan data user baru
public function store(Request $request)
{
    $request->validate([
        'username' => 'required|string|min:3|unique:m_user,username',
        'nama' => 'required|string|max:100',
        'password' => 'required|min:5',
        'level_id' => 'required|integer'
    ]);

    UserModel::insert([
        'username' => $request->username,
        'nama' => $request->nama,
        'password' => Hash::make($request->password),
        'level_id' => $request->level_id
    ]);
    return redirect('/user')->with('success', 'User berhasil disimpan');
}

// Menampilkan detail user
public function show(string $id)
{
    $user = UserModel::with('level')->find($id);

    $breadcrumb = (object) [
        'title' => 'Detail User',
        'list'  => ['Home', 'User', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail User'
    ];

    $activeMenu = 'user'; // set menu yang sedang aktif

    return view('show', [
        'breadcrumb' => $breadcrumb,
        'page'       => $page,
        'user'       => $user,
        'activeMenu' => $activeMenu
    ]);
}

// Menampilkan halaman form edit user
public function edit(string $id)
{
    $user = UserModel::find($id);
    $level = LevelModel::all();

    $breadcrumb = (object) [
        'title' => 'Edit User',
        'list'  => ['Home', 'User', 'Edit']
    ];

    $page = (object) [
        'title' => 'Edit user'
    ];

    $activeMenu = 'user'; // set menu yang sedang aktif

    return view('user.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user, 'level' => $level, 'activeMenu' => $activeMenu]);
}

// Menyimpan perubahan data user
public function update(Request $request, string $id)
{
    $request->validate([
        'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id', // username harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel user kecuali untuk user dengan id yang sedang diedit
        'name'     => 'required|string|max:100', // nama harus diisi, berupa string, dan maksimal 100 karakter
        'password' => 'nullable|string|min:5', // password bisa diisi (minimal 5 karakter) dan bisa tidak diisi
        'level_id' => 'required|integer' // level_id harus diisi dan berupa angka
    ]);

    UserModel::find($id)->update([
        'username' => $request->username,
        'name'     => $request->name,
        'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
        'level_id' => $request->level_id
    ]);

    return redirect('/user')->with('success', 'Data user berhasil diubah');
}

// Menghapus data user



public function create_ajax()
    {
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.create_ajax', compact('level'));
    }


    public function store_ajax(Request $request)
    {
$validator = Validator::make($request->all(),[
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
                ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            UserModel::create([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => bcrypt($request->password),
                'level_id' => $request->level_id
            ]);
           return redirect('/user');
        
        
        }
    
    


public function destroy(string $id)
{
    $check = UserModel::find($id);
    if (!$check) {  // untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
        return redirect('/user')->with('error', 'Data user tidak ditemukan');
    }

    try {
        $check->delete();  // Gunakan instance, bukan `destroy($id)`
        return redirect('/user')->with('success', 'Data user berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}



public function show_ajax(String $id)
     {
         $user = UserModel::find($id);
         $level = LevelModel::select('level_id', 'level_nama')->get();

         return view('user.show_ajax', compact('user', 'level'));
     }

     public function edit_ajax(string $id){
        $user = UserModel::find($id);
        $level = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', compact('user', 'level'));
    }

    public function update_ajax(Request $request, string $id){
        

        $validator = Validator::make($request->all(),[
            'level_id' => 'required|integer',
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama' => 'required|string|max:100',
            'password' => 'nullable|min:6|max:20'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        $user = UserModel::find($id);
        if ($user) {
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->update([
                'username' => $request->username,
                'nama' => $request->nama,
                'level_id' => $request->level_id
            ]);

            return redirect('/user');
        }

        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }

    public function confirm_ajax(String $id)
    {
        $user = UserModel::find($id);
        return view('user.confirm_ajax', compact('user'));
    }

    
    

    }

    









      





