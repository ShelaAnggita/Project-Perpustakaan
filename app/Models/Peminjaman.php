<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    public const STATUS_MENUNGGU_PERSETUJUAN = 'menunggu_persetujuan';
    public const STATUS_DIPINJAM = 'dipinjam';
    public const STATUS_MENUNGGU_PENGEMBALIAN = 'menunggu_pengembalian';
    public const STATUS_DIKEMBALIKAN = 'dikembalikan';
    public const STATUS_DITOLAK = 'ditolak';

    protected $table = 'peminjamen';

    protected $fillable = [
        'user_id',
        'book_id',
        'judul',
        'gambar',
        'status',
        'tanggal_pinjam',
        'batas_kembali',
        'tanggal_pengajuan_kembali',
        'tanggal_dikembalikan',
        'denda',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'batas_kembali' => 'datetime',
        'tanggal_pengajuan_kembali' => 'datetime',
        'tanggal_dikembalikan' => 'datetime',
        'denda' => 'integer',
    ];

    protected $appends = [
        'denda_terhitung',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function getDendaTerhitungAttribute(): int
    {
        if ($this->denda !== null && $this->status !== self::STATUS_DIPINJAM) {
            return $this->denda;
        }

        if (! $this->batas_kembali) {
            return 0;
        }

        $batasKembali = $this->batas_kembali->copy()->startOfDay();
        $patokan = Carbon::parse($this->tanggal_dikembalikan ?? now())->startOfDay();

        if ($patokan->lte($batasKembali)) {
            return 0;
        }

        $telatHari = $batasKembali->diffInDays($patokan);

        return $telatHari * 2000;
    }
}
