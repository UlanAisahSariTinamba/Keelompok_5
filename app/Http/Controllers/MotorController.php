<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Merek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.motor.index', [
            'title' => 'Motor',
            'motor' => Motor::with(['merek'])->orderByDesc('id')->filter(request(['search']))->paginate(10)
            // 'motor' => Motor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.motor.create', [
            'title' => 'Tambah data',
            'merek' => Merek::all()
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
            'nama_motor' => 'required',
            'merek_id' => 'required',
            'warna' => 'required',
            'harga' => 'required',
            'foto' => 'required|mimes:jpeg,jpg,png,gif|max:1024'
        ]);

        $foto_file = $request->file('foto');
        $foto_ext = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ext;
        $foto_file->move(public_path('foto_motor'), $foto_nama);

        $data = [
            'nama_motor' => $request->input('nama_motor'),
            'merek_id' => $request->input('merek_id'),
            'warna' => $request->input('warna'),
            'harga' => $request->input('harga'),
            'image' => $foto_nama
        ];
        Motor::create($data);
        return redirect('dashboard/motor')->with('success_message', 'Data sukses di tambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dashboard.motor.show', [
            'title' => 'Motor',
            'motor' => Motor::where('id', '=', $id)->first()
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
        return view('dashboard.motor.edit', [
            'title' => 'Edit data',
            'motor' => Motor::where('id', '=', $id)->first(),
            'merek' => Merek::all()
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
            'nama_motor' => 'required',
            'merek_id' => 'required',
            'warna' => 'required',
            'harga' => 'required'
        ]);
        $data = [
            'nama_motor' => $request->input('nama_motor'),
            'merek_id' => $request->input('merek_id'),
            'warna' => $request->input('warna'),
            'harga' => $request->input('harga'),
            'updated_at' => date('Y-m-d H:i:s')
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
            $foto_file->move(public_path('foto_motor'), $foto_nama); //Foto sudah terupload ke direktori

            // Hapus foto lama
            $data_foto = Motor::where('id', $id)->first();
            File::delete(public_path('foto_motor') . '/' . $data_foto->image);
            $data['image'] = $foto_nama;
        };
        Motor::where('id', $id)->update($data);
        return redirect("dashboard/motor")->with('success_message', 'Data Sukses di Update!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_foto = Motor::where('id', $id)->first();
        File::delete(public_path('foto_motor') . '/' . $data_foto->image);

        Motor::destroy($id);
        return redirect('dashboard/motor')->with('success_message', 'Data sukses di hapus!');
    }
}
