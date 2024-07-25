<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    public  $fillable = [
        'title',
        'content',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->slug = str_replace(' ', '-', $post->title);
        });
    }
    // Membaca fungsi relasi dari post ke comment dengan tinker
    // $post = new Post()
    // $post = Post::first()
    // Post::active()
    // Post::first()->comments()

    // Menampilkan semua isi data koment berdasar post id
    // Post::first()->comments()->get()
    // Post::first()->comments()->get()->all()
    // Post::first()->comments()->get()->all()[0]

    // Menampilkan isi comment berdasar post id
    // Post::first()->comments()->get()->all()[0]->comment
    // Post::first()->comments()->get()[0]
    // Post::first()->comments()->get()[0]->comment

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function  total_comments()
    {
        // SELECT COUNT(1) FROM comments WHERE ... 
        return $this->comments()->count();
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

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
                return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        });
    }
}
