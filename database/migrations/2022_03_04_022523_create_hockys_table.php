<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHockysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hockys', function (Blueprint $table) {
            $table->id();
            $table->string('ma_hoc_ky', 20)->unique();
            $table->string('mo_ta', 50)->nullable();
            $table->string('trang_thai', 10)->default('Đóng');   // Mở, đóng
            $table->integer('hien_tai')->default(0);
            $table->integer('da_mo')->default(0);   // 0: Chưa mở, 1: Đã mở
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hockys');
    }
}
