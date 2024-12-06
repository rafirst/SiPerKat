<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use Illuminate\Http\Request;

class RTController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('rts.index');
    }

    public function create()
    {
        return view('rts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_rt' => 'required|string|max:255',
        ]);

        Rt::create([
            'nomor_rt' => $request->nomor_rt,
        ]);

        return redirect()->route('rts.index')->with('success', 'RT berhasil ditambahkan!');
    }
}

// dalam controller ada beberapa fungsi yang sering digunakan:
// 1.Store (request) => yang digunakan untuk mengisi data form dan menyimpan nya kedatabase.
// dan biasanya request itu bersamaan dengan klas nya yaitu validate
// 2. Index => digunakan untuk mengambil semua data dan menampilkan nya ke model index contoh {rts_idnex}
// 3. Create => digunakan untuk menampilkan halaman form untuk menambahkan data baru
// 4. Edit ($id) => digunakan untuk menampilkan formulir data dan mengedit nya dan data itu diambil berdasarkan ID ($id)
// 5. Show ($id) =>digunakan untuk mencari data berdasarkan ID($id) dan menampilkan nya kehalaman model nya
// 6. Update (request) => ya seperti namanya memperbarui dan memvalidasi data sesuai ID
// 7. Destroy ($id) => mencari data sesuai ID ($id) kemudian didalam destroy ada fungsi yang bernama delete untuk menghapus data