<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Transaksi_keluar extends Model
{
    use HasFactory;
    protected $fillable = [
        'barang_id',
        'pelanggan_id',
        'tanggal',
        'jumlah',
        'harga_jual',
    ];
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    
}
