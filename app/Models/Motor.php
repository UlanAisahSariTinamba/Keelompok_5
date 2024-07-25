<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Merek;

class Motor extends Model
{
    use HasFactory;

    // merubah nama tabel
    protected $table = 'motor';

    // data tabel kolom motor yang bisa diinput
    // protected $fillable = ['nama_motor', 'merek_id', 'warna', 'harga', 'image'];

    // selain id tidak boleh diinput ke tabel motor
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        // if (isset($filters['search']) ? $filters['search'] : false) {
        //     return $query->where('nama_motor', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('merek_id', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('warna', 'like', '%' . $filters['search'] . '%')
        //         ->orWhere('harga', 'like', '%' . $filters['search'] . '%');
        // }

        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                return $query->where('nama_motor', 'like', '%' . $search . '%')
                    ->orWhere('merek_id', 'like', '%' . $search . '%')
                    ->orWhere('warna', 'like', '%' . $search . '%')
                    ->orWhere('harga', 'like', '%' . $search . '%');
            });
        });
    }

    public function merek()
    {
        return $this->belongsTo(Merek::class);
    }
}
