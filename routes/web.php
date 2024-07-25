<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\KomikController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LoginWpuController;
use App\Http\Controllers\MerekController;
use App\Http\Controllers\RegisterWpuController;
use App\Http\Controllers\UserController;
use App\Models\Blog;
use App\Models\KategoriBerita;
use App\Models\Berita;
use App\Models\Category;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// welcome laravel
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home.index', [
        'title' => 'Home'
    ]);
});

Route::get('/about', function () {
    return view('home.about', [
        'title' => 'About',
        'nama' => 'Ilmuweb.net',
        'email' => 'affanul@gmail.com'
    ]);
});

Route::get('/blog', [BlogController::class, 'index']);

Route::get('/blog/{slug}', [BlogController::class, 'show']);

// Menampilkan semua data kategori
Route::get('/categories', function () {
    return view('home.categories', [
        'title' => 'Blog Categories',
        'categories' => Category::all()
    ]);
});

// Menampilkan Posting blog berdasar kategori
Route::get('/categories/{category:slug}', function (Category $category) {
    return view('home.category', [
        'title' => $category->name,
        'posts' => $category->blog,
        'category' => $category->name
    ]);
});

// Route::get('blog/{slug}', function ($slug) {

// $blog_post = [
//     [
//         'judul' => 'Judul Pertama',
//         'slug' => 'judul-pertama',
//         'author' => 'Sandika',
//         'body' => 'BBB Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque numquam est suscipit natus et porro quo excepturi, iure illum totam nam repudiandae laboriosam rerum quibusdam molestias ipsum libero quisquam! Qui itaque debitis accusantium ut impedit nesciunt magni inventore nostrum beatae, voluptatibus assumenda sapiente, hic dolore voluptatem perspiciatis esse aliquid laborum in animi ullam adipisci ratione! Minus quaerat voluptates labore dolores omnis vel temporibus incidunt cupiditate voluptatibus, quia hic ex quis consectetur necessitatibus soluta? Cupiditate consequatur dolorum excepturi! Unde iusto sapiente adipisci ex consequatur eligendi perferendis quae ipsa nostrum animi odit laboriosam quisquam esse pariatur temporibus similique at accusamus excepturi, libero magni doloremque dolores eius facere. Consequatur unde expedita accusantium ex dolore id est qui'
//     ],
//     [
//         'judul' => 'Judul Kedua',
//         'slug' => 'judul-kedua',
//         'author' => 'Affanul',
//         'body' => 'AAA Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque numquam est suscipit natus et porro quo excepturi, iure illum totam nam repudiandae laboriosam rerum quibusdam molestias ipsum libero quisquam! Qui itaque debitis accusantium ut impedit nesciunt magni inventore nostrum beatae, voluptatibus assumenda sapiente, hic dolore voluptatem perspiciatis esse aliquid laborum in animi ullam adipisci ratione! Minus quaerat voluptates labore dolores omnis vel temporibus incidunt cupiditate voluptatibus, quia hic ex quis consectetur necessitatibus soluta? Cupiditate consequatur dolorum excepturi! Unde iusto sapiente adipisci ex consequatur eligendi perferendis quae ipsa nostrum animi odit laboriosam quisquam esse pariatur temporibus similique at accusamus excepturi, libero magni doloremque dolores eius facere. Consequatur unde expedita accusantium ex dolore id est qui,'
//     ],
// ];

// $new_post = [];
// foreach ($blog_post as $post) {
//     if ($post["slug"] === $slug) {
//         $new_post = $post;
//     }
// }

// return view('home.blog', [
//     'title' => 'Single Post',
//     'posts' => Blog::find($slug)
// ]);
// });

// Route::get('hello', function () {
//     return view('hello');
//     return view('ping');
// });

// Memanggil controller
// Cara pertama
// Route::get('hello', 'App\Http\Controllers\HelloController@index');

// Cara kedua
Route::get('hello', [HelloController::class, 'index']);
Route::post('hello', [HelloController::class, 'create']);
Route::get('world', [HelloController::class, 'world_message']);

// Login
Route::get('login', [AuthController::class, 'login'])->middleware('isTamu');
Route::post('login', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('register', [AuthController::class, 'register_form'])->middleware('isTamu');
Route::post('register', [AuthController::class, 'register'])->middleware('isTamu');


// Route Resource
// Route::resource('posts', PostController::class);

// Route biasa tanpa resource
// Posts
Route::get('dashboard/posts', [PostController::class, 'index'])->middleware('isLogin');
Route::get('dashboard/posts/create', [PostController::class, 'create'])->middleware('isLogin');
Route::get('dashboard/posts/{id}', [PostController::class, 'show'])->middleware('isLogin');
Route::post('dashboard/posts', [PostController::class, 'store'])->middleware('isLogin');
Route::get('dashboard/posts/{id}/edit', [PostController::class, 'edit'])->middleware('isLogin');
Route::patch('dashboard/posts/{id}', [PostController::class, 'update'])->middleware('isLogin');
Route::delete('dashboard/posts/{id}', [PostController::class, 'destroy'])->middleware('isLogin');

// Pegawai
Route::get('dashboard/pegawai', [PegawaiController::class, 'index'])->middleware('isLogin');
Route::get('dashboard/pegawai/create', [PegawaiController::class, 'create'])->middleware('isLogin');
Route::get('dashboard/pegawai/{id}', [PegawaiController::class, 'show'])->middleware('isLogin');
Route::post('dashboard/pegawai', [PegawaiController::class, 'store'])->middleware('isLogin');
Route::get('dashboard/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->middleware('isLogin');
Route::patch('dashboard/pegawai/{id}', [PegawaiController::class, 'update'])->middleware('isLogin');
Route::delete('dashboard/pegawai/{id}', [PegawaiController::class, 'destroy'])->middleware('isLogin');

// Komik
// Resource Komik
// Route::resource('komik', KomikController::class);
Route::get('dashboard/komik', [KomikController::class, 'index'])->middleware('isLogin');
Route::get('dashboard/komik/create', [KomikController::class, 'create'])->middleware('isLogin');
Route::get('dashboard/komik/{id}', [KomikController::class, 'show'])->middleware('isLogin');
Route::post('dashboard/komik', [KomikController::class, 'store'])->middleware('isLogin');
Route::get('dashboard/komik/{id}/edit', [KomikController::class, 'edit'])->middleware('isLogin');
Route::patch('dashboard/komik/{id}', [KomikController::class, 'update'])->middleware('isLogin');
Route::delete('dashboard/komik/{id}', [KomikController::class, 'destroy'])->middleware('isLogin');

// Motor
// Route::resource('motor', MotorController::class)->middleware('auth');
Route::resource('/dashboard/motor', MotorController::class)->middleware('auth');

// Login WPU, user yang belum login maka akan di arahkan
Route::get('/login_wpu', [LoginWpuController::class, 'index'])->name('login')->middleware('guest');
// Autenticate User
Route::post('/login_wpu', [LoginWpuController::class, 'autenticate']);
// logout 
Route::post('/logout', [LoginWpuController::class, 'logout']);

// Register WPU
Route::get('/register_wpu', [RegisterWpuController::class, 'index'])->middleware('guest');
Route::post('/register_wpu', [RegisterWpuController::class, 'store']);

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'dashboard'
    ]);
})->middleware('auth');

// Authorization, Gate, Policies, disini menggunakan Gate Kategori Merek Motor, selain admin tidak bisa akses ke kontroler merek
// Gate, buat middleware sendiri dengan nama sesuka anda, disini menggunaakan is_admin
// Daftarkan ke Midleware Kernel.php dan AppServiceProvider
Route::resource('dashboard/merek', MerekController::class)->except('show')->middleware('is_admin');

// Menampilkan berdasar kategori berita
Route::get('/dashboard/berita/kategori/{kategori_berita:slug}', function (KategoriBerita $kategori_berita) {
    $berita = $kategori_berita->berita()->latest()->paginate(3);
    $title = $kategori_berita->nama;
    $kategori = $kategori_berita->nama;
    return view('/dashboard/berita/kategori', compact('berita', 'title', 'kategori'));
})->middleware('auth');

// Berita
Route::get('/dashboard/berita/checkSlug', [BeritaController::class, 'checkSlug'])->middleware('auth');
Route::resource('dashboard/berita', BeritaController::class)->middleware('auth');

// Kategori Berita
Route::get('/dashboard/kategori_berita/checkSlug', [KategoriBeritaController::class, 'checkSlug'])->middleware('auth');
Route::resource('dashboard/kategori_berita', KategoriBeritaController::class)->middleware('is_admin');

// User
Route::resource('dashboard/user', UserController::class)->middleware('is_admin');
