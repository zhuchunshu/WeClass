<?php

namespace App\Excel;

use Maatwebsite\Excel\Concerns\ToModel;

class ClassmatesImport implements ToModel
{
    /**
     * @param array $row
     * @return array
     */
    public function model(array $rows)
    {

        return [];
    }
}
