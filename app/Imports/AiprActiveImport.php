<?php

namespace App\Imports;

use App\Models\Aipr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Str;
use App\Models\Menu;

class AiprActiveImport implements ToModel, WithStartRow
{
    private $unit_id;
    private $menu_id;

    public function __construct($unit_id, $menu_id)
    {
        $this->unit_id = $unit_id;
        $this->menu_id = $menu_id;
    }

    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        $menu = Menu::where('id', $this->menu_id)->first();
            $aiprData = [
                'unit_id'     => $this->unit_id,
                'pno'         => $row[0] ?? null,
                'name'        => $row[1] ?? null,
                'unit'        => $row[2] ?? null,
                'dpsu'        => $row[3] ?? null,
                'grade'       => $row[4] ?? null,
                'designation' => $row[5] ?? null,
                'dob'         => $row[6] ?? null,
                'currect_grade' => $row[7] ?? null,
                'doj_iofs'    => $row[8] ?? null,
                'sex'         => $row[9] ?? null,
                'sno'         => $row[10] ?? null,
                'others'      => $row[11] ?? null,
                'menu_id'     => $this->menu_id,
                'created_by'  => auth()->id(),
            ];
            return new Aipr($aiprData);
    }
}
