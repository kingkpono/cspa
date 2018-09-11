<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned()->index();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('service_type_id')->unsigned()->index();
            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');
            $table->integer('device_id')->unsigned()->index();
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->string('serial_number')->nullable();
            $table->string('device_description')->nullable();
            $table->enum('device_warranty', array('6 months', '1 year','2 year'))->nullable();
            $table->string('project_details');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', array('Pending', 'Closed',' In Progress'));
            $table->string('project_officers');
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('sales_tickets');
    }
}
