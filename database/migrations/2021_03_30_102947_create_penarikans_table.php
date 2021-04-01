<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenarikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penarikan', function (Blueprint $table) {
            $table->char('kode',20)->primary();
            $table->string('kodeSimpanan', 20);
            $table->string('idAnggota', 20);
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('saldo');
            $table->integer('saldoAkhir');
            $table->timestamps();

            $table->foreign('kodeSimpanan')->references('kode')->on('simpanan')
            ->onDelete('cascade')
            ->onUpdate('cascade');

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
        Schema::dropIfExists('penarikan');
    }
}
