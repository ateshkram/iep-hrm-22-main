<?php

namespace App\Exports;

use App\Models\Leave\LeaveType;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeaveTypesExport implements FromCollection
{
    public function headings(): array {
    return [
       "username","name","gender","email"
    ];
  }

      /**
  * @return \Illuminate\Support\Collection
  */
  public function collection() {

     return collect(LeaveType::all());
     // return Page::getUsers(); // Use this if you return data from Model without using toArray().
  }
}
