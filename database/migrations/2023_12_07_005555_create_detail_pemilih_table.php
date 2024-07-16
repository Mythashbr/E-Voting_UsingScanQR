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
        Schema::create('tb_detail_pemilihan', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detail_pemilihan');
    }
};

class UpdateForeignKeysOnTbDetailPemilihan extends Migration
{
    public function up()
    {
        Schema::table('tb_detail_pemilihan', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('tb_detail_pemilihan', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->foreign('id_user')->references('id')->on('users');
        });
    }
}
