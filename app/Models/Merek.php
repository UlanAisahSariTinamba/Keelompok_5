<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merek extends Model
{
    use HasFactory;

    protected $table = 'merek';
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {

        // Search
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                return $query->where('nama', 'like', '%' . $search . '%');
            });
        });
    }
}
