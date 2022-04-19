<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call(HocKySeeder::class);
        $this->call(KhoaHocSeeder::class);
        $this->call(KhoaSeeder::class);
        $this->call(MonHocSeeder::class);
        $this->call(NganhHocSeeder::class);
        $this->call(LopHocSeeder::class);
        // $this->call(SinhVienSeeder::class);
        // $this->call(TaiKhoanSeeder::class);
    }
}
