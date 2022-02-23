<?php

namespace App\Exports;

use App\Models\Billreciepts_copy;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SearchBillingExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $bills = Billreciepts_copy::all();
        return view('exports.bills', ['bills' => $bills]);
    }
}
