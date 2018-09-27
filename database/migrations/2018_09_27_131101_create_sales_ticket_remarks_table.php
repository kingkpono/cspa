<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTicketRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_ticket_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();         
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('sales_ticket_id')->unsigned()->index();
            $table->foreign('sales_ticket_id')->references('id')->on('sales_tickets')->onDelete('cascade');   
            $table->string('remark');
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
        Schema::table('sales_ticket_remarks', function (Blueprint $table) {
            $table->dropForeign('user_id_foreign');
            $table->dropForeign('sales_ticket_id_foreign');
        });
        
        Schema::dropIfExists('sales_ticket_remarks');
    }
}
