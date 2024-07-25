<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Merek;
use App\Models\Motor;
use App\Models\Berita;
use App\Models\KategoriBerita;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Input data dengan Seeder
        // Motor::create([
        //     'nama_motor' => 'Honda PCX',
        //     'merek_id' => 1,
        //     'warna' => 'Putih',
        //     'harga' => 40000000,
        //     'image' => 'default.jpg'
        // ]);
        // Motor::create([
        //     'nama_motor' => 'Honda ADV',
        //     'merek_id' => 1,
        //     'warna' => 'Hitam',
        //     'harga' => 50000000,
        //     'image' => 'default.jpg'
        // ]);
        // Motor::create([
        //     'nama_motor' => 'Honda Supra X',
        //     'merek_id' => 1,
        //     'warna' => 'Putih',
        //     'harga' => 10000000,
        //     'image' => 'default.jpg'
        // ]);
        // Input data Berita
        // Berita::create([
        //     'kategori_id' => 1,
        //     'user_id' => 1,
        //     'judul' => 'Berita Kedua',
        //     'slug' => 'berita-kedua',
        //     'isi_berita' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deleniti, suscipit! Reiciendis incidunt ipsa veniam est quam amet magni provident, at dolore, reprehenderit placeat laudantium eligendi harum dolorem aspernatur nobis consequatur?',
        //     'gambar' => 'default.jpg'
        // ]);

        KategoriBerita::create([
            'nama' => 'Nasional'
        ]);
        KategoriBerita::create([
            'nama' => 'Lokal'
        ]);
        KategoriBerita::create([
            'nama' => 'Pilihan'
        ]);

        // Memasukan data menggunakan Factory Motor
        // Motor::factory(10)->create();

        // Merek motor
        // Merek::create([
        //     'nama' => 'Honda'
        // ]);
        // Merek::create([
        //     'nama' => 'Suzuki'
        // ]);
        // Merek::create([
        //     'nama' => 'Yamaha'
        // ]);
    }
}
