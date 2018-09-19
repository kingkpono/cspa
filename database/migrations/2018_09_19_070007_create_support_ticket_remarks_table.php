<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTicketRemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_ticket_remarks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();         
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('support_ticket_id')->unsigned()->index();
            $table->foreign('support_ticket_id')->references('id')->on('support_tickets')->onDelete('cascade');   
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
        Schema::table('support_ticket_remarks', function (Blueprint $table) {
            $table->dropForeign('user_id_foreign');
            $table->dropForeign('support_ticket_id_foreign');
        });
        
        Schema::dropIfExists('support_ticket_remarks');
    }
}
