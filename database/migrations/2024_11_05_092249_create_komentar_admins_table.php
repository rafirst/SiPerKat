<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('komentar_admins', function (Blueprint $table) {
            $table->id(); // Ini sudah otomatis menambahkan kolom id
            $table->bigInteger('permohonan_id')->unsigned();
            $table->bigInteger('user_admin_id')->unsigned();
            $table->text('isi_komentar');
            $table->date('tanggal_komentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komentar_admins');
    }
};
