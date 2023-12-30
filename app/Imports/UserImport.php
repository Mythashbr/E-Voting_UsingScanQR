<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;

class UserImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'name' => $row[0],
            'username' => $row[1],
            'password' => bcrypt($row[1]),
            'id_role' => 2,
        ]);
    }
}
