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
            $table->string('mobile');
            $table->string('work_phone');
            $table->string('bdm_person');
            $table->integer('sector_id')->unsigned()->index();;
            $table->foreign('sector_id')->references('id')->on('sector')->onDelete('cascade');
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
        });

        Schema::dropIfExists('clients');
    }
}