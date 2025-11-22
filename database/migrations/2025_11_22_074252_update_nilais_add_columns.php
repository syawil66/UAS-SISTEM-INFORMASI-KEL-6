<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('nilais', function (Blueprint $table) {
        $table->unsignedBigInteger('mapel_id')->after('guru_id');
        $table->unsignedBigInteger('kelas_id')->after('mapel_id')->nullable();

        $table->integer('nilai_tugas')->default(0);
        $table->integer('nilai_uts')->default(0);
        $table->integer('nilai_uas')->default(0);

        $table->dropColumn(['mapel', 'kelas', 'nilai']);
    });
}

public function down()
{
    Schema::table('nilais', function (Blueprint $table) {
        $table->dropColumn(['mapel_id','kelas_id','nilai_tugas','nilai_uts','nilai_uas']);

        $table->string('mapel');
        $table->string('kelas');
        $table->integer('nilai');
    });
}
};
