<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_umum', function (Blueprint $table) {
            $table->id();
            $table->string('noTransaksi');
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->enum('status', ['DEBIT', 'KREDIT']);
            $table->string('keterangan');
            $table->unsignedBigInteger('noAkun');
            $table->foreignId('idAdmin')->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();

            $table->foreign('noAkun')->references('noAkun')->on('akun')
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
        Schema::dropIfExists('jurnal_umum');
    }
}
