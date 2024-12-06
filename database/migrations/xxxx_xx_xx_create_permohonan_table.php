<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nomor_surat')->unique();
            $table->string('pindah_ke_rt');
            $table->text('alasan_pindah')->nullable();
            $table->text('alamat');
            $table->string('no_telp', 15)->nullable()->default(null);
            $table->enum('status', ['proses', 'diterima', 'ditolak'])->default('proses');
            $table->text('admin_comment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permohonan');
    }
}; 