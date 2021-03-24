<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('nama', 50);
            $table->text('alamat');
            $table->string('tempatLahir', 50);
            $table->date('tanggalLahir');
            $table->enum('jenisKelamin', ['L', 'P']);
            $table->string('pekerjaan', '30');
            $table->char('umur', '2');
            $table->timestamps();

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
        Schema::dropIfExists('anggota');
    }
}
