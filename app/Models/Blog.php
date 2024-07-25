<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Blog extends Model
{
    use HasFactory, Sluggable;
    protected $table = 'blog';
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

// class Blog
// {
//     private static $blog_post = [
//         [
//             'judul' => 'Judul Pertama',
//             'slug' => 'judul-pertama',
//             'author' => 'Sandika',
//             'body' => 'BBB Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque numquam est suscipit natus et porro quo excepturi, iure illum totam nam repudiandae laboriosam rerum quibusdam molestias ipsum libero quisquam! Qui itaque debitis accusantium ut impedit nesciunt magni inventore nostrum beatae, voluptatibus assumenda sapiente, hic dolore voluptatem perspiciatis esse aliquid laborum in animi ullam adipisci ratione! Minus quaerat voluptates labore dolores omnis vel temporibus incidunt cupiditate voluptatibus, quia hic ex quis consectetur necessitatibus soluta? Cupiditate consequatur dolorum excepturi! Unde iusto sapiente adipisci ex consequatur eligendi perferendis quae ipsa nostrum animi odit laboriosam quisquam esse pariatur temporibus similique at accusamus excepturi, libero magni doloremque dolores eius facere. Consequatur unde expedita accusantium ex dolore id est qui'
//         ],
//         [
//             'judul' => 'Judul Kedua',
//             'slug' => 'judul-kedua',
//             'author' => 'Affanul',
//             'body' => 'AAAA Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque numquam est suscipit natus et porro quo excepturi, iure illum totam nam repudiandae laboriosam rerum quibusdam molestias ipsum libero quisquam! Qui itaque debitis accusantium ut impedit nesciunt magni inventore nostrum beatae, voluptatibus assumenda sapiente, hic dolore voluptatem perspiciatis esse aliquid laborum in animi ullam adipisci ratione! Minus quaerat voluptates labore dolores omnis vel temporibus incidunt cupiditate voluptatibus, quia hic ex quis consectetur necessitatibus soluta? Cupiditate consequatur dolorum excepturi! Unde iusto sapiente adipisci ex consequatur eligendi perferendis quae ipsa nostrum animi odit laboriosam quisquam esse pariatur temporibus similique at accusamus excepturi, libero magni doloremque dolores eius facere. Consequatur unde expedita accusantium ex dolore id est qui,'
//         ],
//     ];
//     public static function all()
//     {
//         // array biasa
//         // return self::$blog_post;

//         // Collection
//         return collect(self::$blog_post);
//     }

//     public static function  find($slug)
//     {
//         $posts = static::all();

//         // Array biasa
//         // $post = [];
//         // foreach ($posts as $p) {
//         //     if ($p['slug'] === $slug) {
//         //         $post = $p;
//         //     }
//         // }

//         // Collection
//         return $posts->firstWhere('slug', $slug);
//     }
// }
