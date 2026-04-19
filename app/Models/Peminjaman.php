<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Peminjaman extends Model
{
    public const STATUS_MENUNGGU_PERSETUJUAN = 'menunggu_persetujuan';
    public const STATUS_DIPINJAM = 'dipinjam';
    public const STATUS_MENUNGGU_ACC = 'menunggu_acc';
    public const STATUS_DISETUJUI = 'disetujui';
    public const STATUS_SELESAI = 'selesai';
    // Legacy statuses (for backward compatibility)
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
        'kondisi',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'datetime',
        'batas_kembali' => 'datetime',
        'tanggal_pengajuan_kembali' => 'datetime',
        'tanggal_dikembalikan' => 'datetime',
        'denda' => 'integer',
        'kondisi' => 'string',
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
        if ($this->denda !== null && !in_array($this->status, [self::STATUS_DIPINJAM, self::STATUS_MENUNGGU_ACC])) {
            return $this->denda;
        }

        if (! $this->batas_kembali) {
            return 0;
        }

        $batasKembali = $this->batas_kembali->copy()->startOfDay();
        $patokan = Carbon::parse($this->tanggal_dikembalikan ?? now())->startOfDay();

        if ($patokan->lte($batasKembali)) {
            $lateDays = 0;
        } else {
            $lateDays = $batasKembali->diffInDays($patokan);
        }

        // Calculate base fine based on late days
        $fine = $lateDays * 2000;

        // Add condition-based fine if kondisi is set
        if ($this->kondisi) {
            $fine += match ($this->kondisi) {
                'rusak' => 30000,
                'hilang' => 100000,
                default => 0,
            };
        }

        return $fine;
    }
}
