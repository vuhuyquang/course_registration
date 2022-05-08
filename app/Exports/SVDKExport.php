<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\SVDK;

class SVDKExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('quantrivien.qlhocphan.exports', [
            'svdks' => SVDK::where('hoc_phan_id', $this->id)->get()
        ]);
    }
}
