<?php
/**
 * Created by PhpStorm.
 * User=> MY-PC
 * Date=> 8/28/2018
 * Time=> 10=>13 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {



        // Add the client
        Client::create([
            "name"=>"ABC & Sons",
            "email"=>"prospect@yahoo.com",
            "client_type"=>"Prospect",
            "service_type_id"=>1,
            "sector_id"=>1,
            "vendor_status"=>"Pending",
            "contact_person"=> "Abiola",
            "mobile"=> "08025499721",
            "bdm_person_id"=> 1,
            "address"=> "Lagos",
 

        ]);
    }

}