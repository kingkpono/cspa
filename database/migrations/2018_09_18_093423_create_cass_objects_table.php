<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCassObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cass_objects', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');
            $table->integer('service_type_id')->unsigned()->index();
            $table->foreign('cass_type_id')->references('id')->on('cass_types')->onDelete('cascade');
            $table->integer('cass_type_id')->unsigned()->index();         
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('client_id')->unsigned()->index();
            $table->string('due_month');
            $table->string('due_year');
            $table->string('location');
            $table->string('remark')->nullable();
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
            $table->dropForeign('service_type_id_foreign');
            $table->dropForeign('cass_type_id_foreign');
            $table->dropForeign('client_id_foreign');
            $table->dropForeign('user_id_foreign');
            
        });
        
        Schema::dropIfExists('cass_objects');
    }
}
