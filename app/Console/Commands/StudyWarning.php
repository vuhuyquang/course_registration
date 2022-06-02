<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StudyWarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:study_warning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Study Warning';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sinhvien = SinhVien::groupBy('sinh_vien_id')->where('danh_gia', 'Học lại')->get();
        dd($sinhvien);
    }
}
