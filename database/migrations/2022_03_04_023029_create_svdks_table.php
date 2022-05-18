<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSvdksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('svdks', function (Blueprint $table) {
            $table->id();
            $table->integer('hoc_phan_id');
            $table->integer('sinh_vien_id');
            $table->integer('mon_hoc_id');
            $table->integer('so_tin_chi');
            $table->integer('nganh_id');
            $table->string('ma_hoc_ky', 20);
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
        Schema::dropIfExists('svdks');
    }
}
