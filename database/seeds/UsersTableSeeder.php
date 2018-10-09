<?php
/**
 * Created by PhpStorm.
 * User: MY-PC
 * Date: 8/28/2018
 * Time: 10:13 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\Auth\User;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {



        // Add the user
        User::create([
            'name' => 'Kazeem Abiodun',
            'email' => 'kazeem.abiodun@sbtelecoms.com',
            'department' => 'BDM',
            'phone' => '08025499721',
            'role' => 'Staff',
            'password' => bcrypt('almond.2'),
            'remember_token' => str_random(10),
            'api_token' => str_random(60),

        ]);


         // Add the user
         User::create([
            'name' => 'KP Akpabio',
            'email' => 'kpono.akpabio@sbtelecoms.com',
            'department' => 'PAD',
            'phone' => '08025499721',
            'role' => 'Admin',
            'password' => bcrypt('almond.2'),
            'remember_token' => str_random(10),
            'api_token' => str_random(60),

        ]);
    }

}