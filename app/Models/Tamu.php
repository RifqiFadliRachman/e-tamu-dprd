<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
   protected $fillable = [
    'nama',
    'instansi',
    'jabatan',
    'nomor_kontak',
    'jenis_kunjungan',
    'jumlah_peserta',
    'tanggal_kunjungan',
    'waktu_kunjungan',
    'tujuan_kunjungan',
    'surat_permohonan_path',
    'surat_tugas_path',
];
}