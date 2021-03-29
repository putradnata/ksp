<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAngsuransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('angsuran', function (Blueprint $table) {
            $table->char('kode',20)->primary();
            $table->string('kodePinjaman', 20);
            $table->date('tanggalBayar');
            $table->date('tanggalTempo');
            $table->char('pembayaranKe',2);
            $table->char('pokok',20);
            $table->char('denda',20);
            $table->float('bunga');
            $table->bigInteger('jumlah');
            $table->timestamps();

            $table->foreign('kodePinjaman')->references('kode')->on('pinjaman')
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
        Schema::dropIfExists('angsuran');
    }
}
