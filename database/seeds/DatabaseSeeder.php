<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(BdmPeopleTableSeeder::class);
         $this->call(SectorsTableSeeder::class);
         $this->call(ClientsTableSeeder::class);
         $this->call(DevicesTableSeeder::class);
         $this->call(ServiceTypesTableSeeder::class);
         $this->call(CassTypesTableSeeder::class);

    }
}
