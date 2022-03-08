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
            $table->string('ma_hoc_ky')->unique();
            $table->string('mo_ta');
            $table->string('trang_thai');   // Mở, đóng
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
