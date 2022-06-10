<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HocKy;
use App\Models\SinhVien;
use App\Models\MonHoc;
use App\Models\HocPhan;
use Illuminate\Support\Str;
use DB;

class OpenTerm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'year:open_term';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Open Term';

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
        $hocky = DB::table('hockys')->update(array('hien_tai' => 0));

        // Tạo học kỳ mới và mở luôn
        $thang = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->month;
        $nam = \Carbon\Carbon::now('Asia/Ho_Chi_Minh')->year;
        if ($thang >= 8) {
            $namSau = $nam + 1;
            $mahocky = $nam . '_' . $namSau . '_1';
            $mota = 'Học kỳ 1 năm học ' . $nam . ' - ' . $namSau;
        } else {
            $namTruoc = $nam - 1;
            $mahocky = $namTruoc . '_' . $nam . '_2';
            $mota = 'Học kỳ 2 năm học ' . $namTruoc . ' - ' . $nam;
        }
        $hocky = new HocKy;
        $hocky->ma_hoc_ky = $mahocky;
        $hocky->mo_ta = $mota;
        $hocky->trang_thai = 'Mở';
        $hocky->hien_tai = 0;
        $hocky->da_mo = 1;
        $hocky->save();

        // Tăng số kỳ học của sv lên 1
        $sinhviens = SinhVien::all();
        foreach ($sinhviens as $i => $sinhvien) {
            $sinhvien->so_ky_hoc = $sinhvien->so_ky_hoc + 1;
            $sinhvien->save();
        }

        // Tạo 3 học phần từ mỗi môn học
        $monhocmodks = MonHoc::where('duoc_phep', 1)->get();
        foreach ($monhocmodks as $key => $monhocmodk) {
            for ($i = 1; $i <= 3; $i++) {
                $hocphan = new HocPhan;
                $hocphan->ma_lop = Str::upper(substr(md5($monhocmodk->ma_mon_hoc . Str::upper(Str::random(8)) . time()), 0, 10));
                $hocphan->ma_hoc_phan = $monhocmodk->ma_mon_hoc;
                $hocphan->mon_hoc_id = $monhocmodk->id;
                $hocphan->so_tin_chi = $monhocmodk->so_tin_chi;
                $hocphan->ma_hoc_ky = $hocky->ma_hoc_ky;
                $hocphan->save();
            }
        }
    }
}
