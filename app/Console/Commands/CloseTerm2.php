<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\HocKy;
use App\Models\SVDK;
use App\Models\MonHoc;
use App\Models\HocPhan;
use App\Models\HocPhi;

class CloseTerm2 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'year:close_term2';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close Term 2';

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
        $hocky = HocKy::where('trang_thai', 'Mở')->first();
        $mhk = $hocky->ma_hoc_ky;

        // Xóa học kỳ nếu sĩ số <=1 hoặc >60
        $hocphans = HocPhan::where('ma_hoc_ky', $mhk)->where('da_dang_ky', '<=', 1)->orWhere('da_dang_ky', '>', 60)->get();
        foreach ($hocphans as $key => $hocphan) {
            if ($hocphan->giu_lai == 1) {
                $hocphan->delete();
            } else {
                $hocphan->forceDelete();
            }
            $svhdk = SVDK::where('hoc_phan_id', $hocphan->id)->delete();
        }

        // Cập nhật trạng thái học kỳ
        $hocky->trang_thai = 'Đóng';
        $hocky->hien_tai = 1;
        $hocky->save();

        // Cập nhật trạng thái môn học
        $monhocs = MonHoc::where('duoc_phep', 'false')->get();
        foreach ($monhocs as $key => $monhoc) {
            $monhoc->duoc_phep = 'true';
            $monhoc->save();
        }

        // Tạo dữ liệu học phí cho sinh viên
        $hocphis = SVDK::groupBy('sinh_vien_id')
            ->selectRaw('sum(so_tin_chi) as sum, sinh_vien_id')
            ->where('ma_hoc_ky', $mhk)
            ->pluck('sum', 'sinh_vien_id')->toArray();

        foreach ($hocphis as $key => $hocphi) {
            $hp = (int) $hocphi;
            $hocphi = new HocPhi;
            $hocphi->sinh_vien_id = $key;
            $hocphi->so_tin_chi = $hp;
            $hocphi->ma_hoc_ky = $mhk;
            $hocphi->save();
        }
    }
}
