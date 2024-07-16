<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Mencatat baris untuk debugging
        Log::info('Mengimpor baris:', $row);

        // Validasi kolom 'name'
        $validator = Validator::make($row, [
            'name' => 'required|string',
            'username' => 'required|string',
            'id_anggota' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $e) {
            Log::error('Validasi gagal untuk baris:', $row);
            return null; // Abaikan baris yang tidak valid
        }

        return new User([
            'name' => $row['name'],
            'username' => $row['username'],
            'password' => bcrypt($row['username']), // Menggunakan username sebagai password sementara
            'id_anggota' => $row['id_anggota'],
            'email' => $row['email'],
            'id_role' => 2, // Hardcoded role untuk user
        ]);
    }
}

