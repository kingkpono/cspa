<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact_person');
            $table->integer('service_type_id')->unsigned()->index();
            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');    
            $table->string('mobile')->nullable();
            $table->string('work_phone')->nullable();
            $table->integer('bdm_person_id')->unsigned()->index();
            $table->foreign('bdm_person_id')->references('id')->on('bdm_people')->onDelete('cascade');
            $table->integer('sector_id')->unsigned()->index();
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
            $table->enum('vendor_status', array('Pending', 'Completed'));
            $table->enum('client_type', array('Customer', 'Prospect'));
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign('clients_sector_id_foreign');
            $table->dropForeign('clients_bdm_person_id_foreign');
            $table->dropForeign('clients_service_type_id_foreign');

        });
        
        Schema::dropIfExists('clients');
    }
}
