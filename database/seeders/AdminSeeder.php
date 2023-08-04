<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count_admin = count(Admin::all());
        $i = ($count_admin == 0 ? null : $count_admin);
        do{
            Admin::create([
                'name'     => 'admin'.$i,
                'email'    => 'admin'.$i.'@gmail.com',
                'password' => bcrypt('admin123'.$i,),
            ]);
            $i++;
        }while($i<$count_admin+10);
    }
}
