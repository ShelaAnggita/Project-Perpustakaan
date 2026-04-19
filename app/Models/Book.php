<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'judul',
        'penulis',
        'pengarang',
        'penerbit',
        'deskripsi',
        'tahun_terbit',
        'stok',
        'gambar',
    ];

    protected $appends = [
        'stok_tersedia',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function getStokTersediaAttribute(): int
    {
        $dipakai = $this->peminjaman()
            ->whereIn('status', [
                Peminjaman::STATUS_DIPINJAM,
                Peminjaman::STATUS_MENUNGGU_ACC,
                Peminjaman::STATUS_DISETUJUI,
                // For backward compatibility
                Peminjaman::STATUS_MENUNGGU_PENGEMBALIAN,
            ])
            ->count();

        return max(0, (int) $this->stok - $dipakai);
    }

    public function scopeSearch(Builder $query, ?string $keyword): Builder
    {
        if (! $keyword) {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($keyword) {
            $builder->where('judul', 'like', "%{$keyword}%")
                ->orWhere('penulis', 'like', "%{$keyword}%")
                ->orWhere('penerbit', 'like', "%{$keyword}%");
        });
    }
}
