<?php

namespace App\Exports;

use App\Models\Sreports_copy;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SearchStocksExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $stocks = Sreports_copy::all();
        return view('exports.stocks', ['stocks' => $stocks]);
    }

    // public function collection()
    // {
    //     return Sreports_copy::all();
    // }
}
