<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSinhviensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sinhviens', function (Blueprint $table) {
            $table->id();
            $table->string('ma_sinh_vien', 20)->unique();
            $table->string('ho_ten', 50);
            $table->date('ngay_sinh');
            $table->string('gioi_tinh');
            $table->integer('khoa_hoc_id');
            $table->integer('lop_hoc_id');
            $table->string('mat_khau', 50);
            $table->string('que_quan', 80);
            $table->string('email', 50)->unique();
            $table->text('avatar');
            $table->string('quyen');
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
        Schema::dropIfExists('sinhviens');
    }
}
