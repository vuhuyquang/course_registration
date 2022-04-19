<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonhocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monhocs', function (Blueprint $table) {
            $table->id();
            $table->string('ma_mon_hoc', 20)->unique();
            $table->integer('nganh_id');
            $table->string('ten_mon_hoc', 80);
            $table->integer('so_tin_chi');
            $table->string('duoc_phep')->default(1);   //1:đồng ý, 0:không đồng ý
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
        Schema::dropIfExists('monhocs');
    }
}
