<?php

namespace App\Http\Controllers;

use App\Models\Merek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Otentikasi User Autorization
        // Jika user belum login atau User selain sandika tidak bisa akses kategori merek motor, buat midlleware baru, dan pindahkan pindah ke middleware script dibawah ini
        // if (auth()->guest() || auth()->user()->email !== 'sandika@gmail.com') {
        //     abort(403);
        // }

        return view('dashboard.merek.index', [
            'title' => 'Merek',
            'merek' => Merek::latest()->filter(request(['search']))->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.merek.create', [
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
        $validatedData = $request->validate([
            'nama' => 'required|max:255|unique:merek'
        ]);

        Merek::create($validatedData);
        return redirect('dashboard/merek')->with('success_message', 'Data Sukses diambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function show(Merek $merek)
    {
        // $merek = Merek::where('id', '=', $merek)->first();
        // $data = [
        //     'nama' => $merek
        // ];
        // dd($data);
        // return view('dashboard.merek.show',  $data,  [
        //     'title' => 'Nama Merek'
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function edit(Merek $merek)
    {
        return view('dashboard.merek.edit',  [
            'title' => 'Edit',
            'merek' => $merek
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Merek $merek)
    {
        $rules = [
            'nama' => 'required'
        ];
        // kondisi apabila nama merek sama sudah ada ditolak
        if ($request->nama != $merek->nama) {
            $rules['nama'] = 'required|unique:merek';
        }
        $validatedData = $request->validate($rules);

        Merek::where('id', $merek->id)->update($validatedData);
        return redirect('dashboard/merek')->with('success_message', 'Data Sukses di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Merek  $merek
     * @return \Illuminate\Http\Response
     */
    public function destroy(Merek $merek)
    {
        Merek::destroy($merek->id);
        return redirect('dashboard/merek')->with('success_message', ' Data Sukses dihapus!.');
    }
}
