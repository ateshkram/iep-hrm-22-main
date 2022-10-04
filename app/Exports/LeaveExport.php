<?php

namespace App\Exports;

use App\Models\Leave\LeaveType;
use Maatwebsite\Excel\Concerns\FromCollection;

class LeaveExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LeaveType::all();
    }
}
