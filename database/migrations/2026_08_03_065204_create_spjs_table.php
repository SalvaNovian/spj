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
        Schema::create('spjs', function (Blueprint $table) {

        $table->id();

        $table->foreignId('kegiatan_id')->constrained()->cascadeOnDelete();

        $table->foreignId('user_id')->constrained()->cascadeOnDelete();

        $table->string('nomor_spj');

        $table->date('tanggal');

        $table->string('file');

        $table->enum('status', [
        'menunggu',
        'revisi',
        'diterima',
        'ditolak',
        'final'
    ])->default('menunggu');

        $table->text('catatan')->nullable();

        $table->tinyInteger('revisi_ke')->default(0);

        $table->timestamps();

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spjs');
    }
};
