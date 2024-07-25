<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // cek apakah sdah login
        // if (!Auth::check()) {
        //     return redirect('login');
        // }

        // menangkap data search
        // dd(request('search'));

        // Menampilkan semua data pegawai
        // $pegawai = Pegawai::all();

        // menampilkan data pegawai dari yang terbaru
        // $pegawai = DB::table('pegawai')
        //     ->orderByDesc('id')
        //     ->get();

        // Cara ke 2 menampilkan data pegawai
        // $pegawai = Pegawai::latest();

        $view_data = [
            'pegawai' => Pegawai::latest()->filter(request(['search']))->paginate(5)
        ];
        return view('dashboard.pegawai.index', $view_data, [
            'title' => 'Pegawai'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // cek apakah sudah login
        // if (!Auth::check()) {
        //     return redirect('login');
        // }

        return view('dashboard.pegawai.create', [
            'title' => 'Tambah Data'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nip' => 'required|unique:pegawai',
            'foto' => 'required|mimes:jpeg,jpg,png,gif|max:1024'
        ]);

        $foto_file = $request->file('foto');
        $foto_ekst = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekst;
        $foto_file->move(public_path('foto'), $foto_nama);

        $data = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'nip' => $request->input('nip'),
            'foto' => $foto_nama
        ];
        Pegawai::create($data);
        return redirect('dashboard/pegawai')->with('success_message', 'Data Sukses ditambahkan!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pegawai = Pegawai::where('id', '=', $id)->first();
        $view_data = [
            'pegawai' => $pegawai
        ];
        return view('dashboard.pegawai.show', $view_data, [
            'title' => 'Pegawai'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Cek apakah sudah login
        // if (!Auth::check()) {
        //     return redirect('login');
        // }

        $pegawai = Pegawai::where('id', '=', $id)->first();
        $view_data = [
            'pegawai' => $pegawai
        ];
        return view('dashboard.pegawai.edit', $view_data, [
            'title' => 'Edit data'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nip' => 'required',
        ]);

        $data = [
            'nama' => $request->input('nama'),
            'nip' => $request->input('nip'),
            'alamat' => $request->input('alamat'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Kondisi jika ada file foto baru yang akan diupload
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png,gif|max:1024'
            ], [
                'foto.mimes' => 'Foto yang diperbolehkan berekstensi jpeg, jpg, png, gif',
                'foto.max' => 'Ukuran Foto lebih dari 1Mb'
            ]);
            // Proses upload foto baru ke direktori
            $foto_file = $request->file('foto');
            $foto_ekst = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekst;
            $foto_file->move(public_path('foto'), $foto_nama); //Foto sudah terupload ke direktori
            // Hapus foto lama
            $data_foto = Pegawai::where('id', $id)->first();
            File::delete(public_path('foto') . '/' . $data_foto->foto);

            // cara update 1
            // Pegawai::where('id', $id)
            //     ->update([
            //         'foto' => $foto_nama
            //     ]);

            $data['foto'] = $foto_nama;
        };
        // update cara 2
        Pegawai::where('id', $id)->update($data);

        // Cara update 1
        // Pegawai::where('id', $id)
        //     ->update([
        //         'nama' => $request->input('nama'),
        //         'nip' => $request->input('nip'),
        //         'alamat' => $request->input('alamat'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]);

        return redirect("dashboard/pegawai")->with('success_message', 'Data Sukses diupdate!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pegawai::where('id', $id)->first();
        File::delete(public_path('foto') . '/' . $data->foto);

        Pegawai::where('id', $id)->delete();
        return redirect('dashboard/pegawai')->with('success_message', 'Data Sukses dihapus!.');
    }
}
