<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'deskripsi',
        'harga',
        'kategori',
        'gambar',
        'tersedia',
    ];

    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
            'tersedia' => 'boolean',
        ];
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
