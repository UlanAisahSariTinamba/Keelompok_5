<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'pegawai';

    // tabel yang bisa di input
    public  $fillable = [
        'nama',
        'alamat',
        'nip',
        'foto'
    ];

    public function scopeFilter($query, array $filters)
    {
        // cara pertama
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('nama', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('alamat', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('nip', 'like', '%' . $filters['search'] . '%');
        // }

        // cara kedua
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                return $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('nip', 'like', '%' . $search . '%');
            });
        });
    }
}

// Cara menggunakan tinker, perintah pada tinker //

// Menampilkan data pegawai
// DB::table('pegawai')->get();

// Menampilkan data berdasar id
// DB::table('pegawai')->where('id', 2)->get();

// input data dengan tinker

// Intansiasi
// $pegawai = new App\Models\Pegawai();

// input data sesuai property padata tabel Pegawai
// $pegawai->nama = 'Arsy';

// Menampilkan data dalam $pegawai
// $pegawai

// Simpan data ke DB
// $pegawai->save();
