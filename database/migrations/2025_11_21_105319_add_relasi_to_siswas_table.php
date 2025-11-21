<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 public function up(): void
{
    Schema::table('siswas', function (Blueprint $table) {

        // === 1. Relasi kelas ===
        if (!Schema::hasColumn('siswas', 'kelas_id')) {
            $table->unsignedBigInteger('kelas_id')->nullable()->after('foto');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
        }

        

        // === 3. Relasi wali kelas ===
        if (!Schema::hasColumn('siswas', 'wali_kelas_id')) {
            $table->unsignedBigInteger('wali_kelas_id')->nullable()->after('jurusan_id');
            $table->foreign('wali_kelas_id')->references('id')->on('gurus')->onDelete('set null');
        }

        // === 4. (Opsional) Relasi mapel ===
        if (!Schema::hasColumn('siswas', 'mapel_id')) {
            $table->unsignedBigInteger('mapel_id')->nullable()->after('wali_kelas_id');
            $table->foreign('mapel_id')->references('id')->on('mata_pelajarans')->onDelete('set null');
        }

    });
}

public function down(): void
{
    Schema::table('siswas', function (Blueprint $table) {
        $table->dropForeign(['kelas_id']);
        $table->dropForeign(['jurusan_id']);
        $table->dropForeign(['wali_kelas_id']);
        $table->dropForeign(['mapel_id']);

        $table->dropColumn(['kelas_id','jurusan_id','wali_kelas_id','mapel_id']);
    });
}
};