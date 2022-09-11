<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{


    public function run()
    {
        DB::table('users')->delete();
        $admin = new User();

        $admin->firstname = 'wafaa';
        $admin->lastname = 'ezzat';
        $admin->email = 'admin@admin.com';
        $admin->password = Hash::make('11111111');
        $admin->phone = '01123547811';
        $admin->address = 'mitghamer';
        $admin->role = 1;
        $admin->save();
    }
}
