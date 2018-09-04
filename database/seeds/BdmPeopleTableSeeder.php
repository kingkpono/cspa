<?php
/**
 * Created by PhpStorm.
 * User=> MY-PC
 * Date=> 8/28/2018
 * Time=> 10=>13 AM
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use App\Models\BdmPerson;

class BdmPeopleTableSeeder extends Seeder
{

    /**
     * Run the database seed.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {

        // Add the bdm
        BdmPerson::create([
            "name"=>"Kazeem"

        ]);
    }

}