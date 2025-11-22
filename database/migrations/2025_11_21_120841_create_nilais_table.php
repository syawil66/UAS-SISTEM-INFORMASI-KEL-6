<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('nilais', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('siswa_id');
        $table->foreignId('guru_id')->constrained()->onDelete('cascade');
        $table->string('mapel');
        $table->string('kelas');
        $table->integer('nilai');
        $table->timestamps();

        $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
    });
}

};
