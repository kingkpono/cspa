<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlexcomLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flexcom_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile_number');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->integer('client_id')->unsigned()->index();
            $table->enum('platform', array('HYBRID','CORPORATE', 'BSCS', 'IN', 'SMART 5000'));
            $table->date('activation_date');
            $table->enum('status', array('Active', 'Inactive'));
            $table->string('remark')->nullable();
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

        Schema::table('flexcom_lines', function (Blueprint $table) {
            $table->dropForeign('flexcom_lines_client_id_foreign');
        });
        Schema::dropIfExists('flexcom_lines');
    }
}
