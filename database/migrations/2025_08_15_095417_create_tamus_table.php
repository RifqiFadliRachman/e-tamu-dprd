<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamusTable extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('tamus', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('instansi');
        $table->string('jabatan');
        $table->string('nomor_kontak');
        $table->string('jenis_kunjungan');
        $table->integer('jumlah_peserta')->default(1);
        $table->date('tanggal_kunjungan')->nullable();
        $table->string('waktu_kunjungan')->nullable();
        $table->text('tujuan_kunjungan')->nullable();
        $table->string('surat_permohonan_path')->nullable();
        $table->string('surat_tugas_path')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tamus');
    }
};
