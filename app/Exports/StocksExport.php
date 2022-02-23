<?php

namespace App\Exports;

use App\Models\Sreports;
use App\Models\Sreports_copy;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class StocksExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        $stocks = Sreports::all();
        return view('exports.stocks', ['stocks' => $stocks]);
    }
    // public function collection()
    // {
    //     // return Sreports::all();
    // }

}
