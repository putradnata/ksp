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
            $table->char('noTransaksi', '20');
            $table->float('jumlah');
            $table->enum('status', ['debet', 'kredit']);
            $table->string('keterangan');
            $table->unsignedBigInteger('noAkun');
            $table->timestamps();

            $table->foreign('noAkun')->references('noAkun')->on('akun')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('idAdmin')->constrained('users')
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
