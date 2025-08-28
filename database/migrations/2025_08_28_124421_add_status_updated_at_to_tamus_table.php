<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tamus', function (Blueprint $table) {
            // Menambahkan kolom untuk menyimpan timestamp kapan status terakhir diubah
            $table->timestamp('status_updated_at')->nullable()->after('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tamus', function (Blueprint $table) {
            $table->dropColumn('status_updated_at');
        });
    }
};
