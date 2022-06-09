<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SMRemindBirthday;
use App\Models\DiemSo;
use App\Models\SinhVien;
use App\Models\CanhCao;
use App\Models\TaiKhoan;
use Mail;
use App\Mail\SendMailStudyWarning;

class SWCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'minute:study_warning';

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
        $diemsos = DiemSo::groupBy('sinh_vien_id')->selectRaw('sum(diem_tong_ket) as sum, sinh_vien_id, count(*) as count')->get()->toArray();
        foreach ($diemsos as $key => $diemso) {
            $dtb = $diemso['sum'] / $diemso['count'];
            $gpa = round($dtb/10 * 4, 2);
            $sinhvien = SinhVien::find($diemso['sinh_vien_id']);
            if ($gpa < 1.8) {
                $canhcao = CanhCao::where('sinh_vien_id', $diemso['sinh_vien_id'])->get()->toArray();
                if (empty($canhcao)) {
                    $cc = new CanhCao;
                    $cc->sinh_vien_id = $sinhvien->id;
                    $cc->muc_do = 1;
                    $cc->save();
                    $id = $cc->id;
                } else {
                    foreach ($canhcao as $key => $cc) {
                        $cc = CanhCao::find($cc['id']);
                        $cc->muc_do = $cc['muc_do'] + 1;
                        $cc->save();
                        $id = $cc->id;
                    }
                }
                $canhcao = CanhCao::find($id);
                $sinhvien = SinhVien::find($canhcao->sinh_vien_id);
                $taikhoan = TaiKhoan::where('id', $sinhvien->tai_khoan_id)->first();
                $email = $taikhoan->email;
                $mucdo = $canhcao->muc_do;
                //
                if ($mucdo >=5) {
                    continue;
                }
                if ($sinhvien->so_ky_hoc <= 2 && $gpa < 1.2) {
                    // dd('< 1.2');
                    Mail::to($email)->send(new SendMailStudyWarning($sinhvien, $mucdo));
                } elseif ($sinhvien->so_ky_hoc <= 4 && $sinhvien->so_ky_hoc >= 3 && $gpa < 1.4) {
                    // dd('< 1.4');
                    Mail::to($email)->send(new SendMailStudyWarning($sinhvien, $mucdo));
                } elseif ($sinhvien->so_ky_hoc >= 5 && $sinhvien->so_ky_hoc <= 6 && $gpa < 1.6) {
                    // dd('< 1.6');
                    Mail::to($email)->send(new SendMailStudyWarning($sinhvien, $mucdo));
                } elseif ($sinhvien->so_ky_hoc >= 7 && $gpa < 1.8) {
                    // dd('< 1.8');
                    Mail::to($email)->send(new SendMailStudyWarning($sinhvien, $mucdo));
                } 
            }    
        }
    }
}
