<?php
/**
 * Created by PhpStorm.
 * User=> MY-PC
 * Date=> 8/28/2018
 * Time=> 10=>13 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\CassType;

class CassTypesTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {



        // Add the sector
        CassType::create([
            "cass_type"=>"CAS MONTHLY"

        ]);

        CassType::create([
            "cass_type"=>"CAS QUARTERLY"

        ]);
         
        CassType::create([
            "cass_type"=>"CAS BI-ANNUAL"

        ]);
        CassType::create([
            "cass_type"=>"CORRECTIVE MAINTENANCE"

        ]);
       
    }

}