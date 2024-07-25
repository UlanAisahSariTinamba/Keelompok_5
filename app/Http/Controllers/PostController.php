<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Tutorial 1
        // mengambil data dari storage posts.txt
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        // $view_data = [
        //     'posts' => $posts
        // ];

        // Array statis
        // $view_data = [
        //     'posts' => [
        //         // Title                Content
        //         ["Mengenal Laravel", "Ini adalah blog pengenalan laravel"],
        //         ["Tentang Codepolitan", "Ini adalah blog belajar Laravel tentang Codepolitan"],
        //         ["Tentang Ilmu website", "Ini adalah blog belajar Laravel tentang Ilmu website"],
        //         ["Belajar Codeigniter 4", "Ini adalah blog belajar Codeigniter 4"],
        //     ]
        // ];
        // return view('posts.index', $view_data);

        // Tutorial 2
        // $posts = DB::table('posts')
        //     ->select('id', 'title', 'content', 'created_at')
        //     ->where('active', true)
        // ->orderByDesc('id')
        // ->limit(2)
        // ->get();

        // Cek kondisi apakah sudah login, jika belum redirect ke halaman login
        // tanpa menggunakan middleware
        // if (!Auth::check()) {
        //     return redirect('login');
        // }

        // Tutorial 3 dengan model
        $posts = Post::active()->latest()->filter(request(['search']))->paginate(5);

        // Menampilkan data softDeletes
        // $posts = Post::active()->withTrashed()->get();

        $view_data = [
            'posts' => $posts
        ];
        return view('dashboard.posts.index', $view_data, [
            'title' => 'Post'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Cek sesi apakah sudah login
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        return view('dashboard.posts.create', [
            'title' => 'Tambah data'
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
        // Tutorial 1
        // $title = $request->input('title');
        // $content = $request->input('content');

        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        // $new_post = [
        //     count($posts) + 1,
        //     $title,
        //     $content,
        //     date('Y-m-d H:i:s')
        // ];
        // $new_post = implode(',', $new_post);
        // array_push($posts, $new_post);
        // $posts = implode("\n", $posts);
        // Menyimpan data
        // Storage::write('posts.txt', $posts);

        // return   redirect('posts');

        // Tutorial 2
        // $title = $request->input('title');
        // $content = $request->input('content');

        // DB::table('posts')->insert([
        //     'title' => $title,
        //     'content' => $content,
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);

        // Cara 2 Simpan Data dari input form
        // $title = $request->input('title');
        // $content = $request->input('content');

        // Post::create([
        //     'title' => $title,
        //     'content' => $content,
        // ]);

        // return   redirect('posts');

        //  Cara 3 validasi & simpan data dari input form
        // validasi data
        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        // Simpan data ke tabel
        Post::create($validatedData);
        // Kembali ke halaman index post
        return   redirect('dashboard/posts')->with('success', 'Data Berhasil Ditambahkan!.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Cek apakah user sudah login
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        // $posts = Storage::get('posts.txt');
        // $posts = explode("\n", $posts);
        // $selected_post = array();
        // foreach ($posts as $post) {
        //     $post = explode(",", $post);
        //     if ($post[0] == $id) {
        //         $selected_post = $post;
        //     }
        // }

        // $view_data = [
        //     'post' => $selected_post
        // ];
        // return view('posts.show', $view_data);

        // Tutorial 2
        // Mengakses hanya satu data 
        // $post = DB::table('posts')
        //     ->select('id', 'title', 'content', 'created_at')
        //     ->where('id', '=', $id)
        //     ->first();
        // $view_data = [
        //     'post' => $post
        // ];

        // Tutorial 3 menggunakan Eloquent
        $post = Post::where('id', '=', $id)->first();
        $comments = $post->comments()->limit(3)->get();
        $total_comments = $post->total_comments();
        $view_data = [
            'post'      => $post,
            'comments'  => $comments,
            'total_comments' => $total_comments,
        ];

        return view('dashboard.posts.show', $view_data, [
            'title' => 'Post'
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
        // Cek apakah user sudah login
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        // Tutorial 1 query builder
        // $post = DB::table('posts')
        //     ->select('id', 'title', 'content', 'created_at')
        //     ->where('id', '=', $id)
        //     ->first();
        // $view_data = [
        //     'post' => $post
        // ];

        // Tutorial 2 menggunakan eloquent
        $post = Post::where('id', '=', $id)->first();
        $view_data = [
            'post' => $post
        ];

        return view('dashboard.posts.edit', $view_data, [
            'title' => 'Edit'
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
        $title = $request->input('title');
        $content =  $request->input('content');
        $slug = str_replace(' ', '-', $title);

        // Tutorial menggunakan Query builder
        // DB::table('posts')
        //     ->where('id', $id)
        //     ->update([
        //         'title' => $title,
        //         'content' => $content,
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]);

        // Tutorial 2 menggunakan eloquent      
        Post::where('id', $id)
            ->update([
                'title' => $title,
                'content' => $content,
                'slug' => $slug,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect("dashboard/posts/{$id}")->with('success', 'Data Berhasil Update!.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Cek apakah user sudah login
        // if (!Auth::check()) {
        //     return redirect('login');
        // }
        // Tutorial 1 dengan query builder
        // DB::table('posts')
        //     ->where('id', $id)
        //     ->delete();
        // Tutorial 2 dengan eloquent
        Post::where('id', $id)->delete();
        return redirect('dashboard/posts')->with('success', 'Data Berhasil Dihapus!.');
    }
}
