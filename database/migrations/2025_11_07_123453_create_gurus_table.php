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
        Schema::create('gurus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('nip')->unique();
            $table->string('bidang_ajar')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->boolean('is_wali_kelas')->default(false);
            $table->string('no_hp')->nullable();

            //kolom sensitif
            $table->string('npwp')->nullable();
            $table->string('no_rekening')->nullable();
            $table->string('golongan')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gurus');
    }
};
