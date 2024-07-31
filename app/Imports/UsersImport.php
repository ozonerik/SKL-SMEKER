<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UsersImport implements ToCollection,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $user= User::create([
                'name'     => $row['name'],
                'email'    => $row['email'], 
                'password' => Hash::make($row['password']),
            ]);

            $user->assignRole('user');
        }

    }

    public function headingRow(): int
    {
        return 1; //heading berada pada baris ke -1
    }

}
