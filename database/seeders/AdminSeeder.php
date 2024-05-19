<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Secretary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;



class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@example.com',
        //     'password' => Hash::make('password'),
        // ]);




        $user = new Secretary();
        $user->firstname = 'assef';
        $user->lastname = 'Dk';
        $user->username = 'admin';
        $user->password = Hash::make(12345); 
        $user->phone = '0994437001';
        $user->address = 'malke';
        $user->email = 'admin@gmail.com';
        $user->birthdate = Carbon::now();
        $user->fathername = 'fname';
        $user->mothername = 'mname';
        $user->gender = 'male';
        $user->isadmin = 1;
        $user->save();


        Auth::guard('admin')->login($user);


    }
}
