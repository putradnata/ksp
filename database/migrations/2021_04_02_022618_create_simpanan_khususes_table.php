<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSimpananKhususesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simpanan_khusus', function (Blueprint $table) {
            $table->char('kode',20)->primary();
            $table->string('idAnggota', 20);
            $table->date('tanggal');
            $table->bigInteger('jumlah');
            $table->bigInteger('saldo');
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
        Schema::dropIfExists('simpanan_khusus');
    }
}
