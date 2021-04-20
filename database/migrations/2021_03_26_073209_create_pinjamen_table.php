<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->char('kode',20)->primary();
            $table->string('idAnggota', 20);
            $table->date('tanggal');
            $table->char('jaminan',20);
            $table->bigInteger('jumlah');
            $table->enum('statusPinjaman', ['Lunas', 'Belum Lunas']);
            $table->timestamps();

            $table->foreign('idAnggota')->references('id')->on('anggota')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pinjaman');
    }
}
