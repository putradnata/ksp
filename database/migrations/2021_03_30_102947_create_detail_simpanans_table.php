<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSimpanansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_simpanan', function (Blueprint $table) {
            $table->char('kode',20)->unique();
            $table->string('kodeSimpanan', 20);
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->integer('saldo');
            $table->string('keterangan', 20);
            $table->timestamps();

            $table->foreign('kodeSimpanan')->references('kode')->on('simpanan')
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
        Schema::dropIfExists('detail_simpanan');
    }
}
