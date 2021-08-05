<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScirptdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scirptdetails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prescription_id');
            $table->bigInteger('patient_id');
            $table->string('drug_name');
            $table->string('drug_pic_url')->nullable();
            $table->string('drug_code');
            $table->string('drug_amount')->default('0');
            $table->string('day')->default('0');
            $table->string('time_morning',1)->default('0');
            $table->string('time_noon',1)->default('0');
            $table->string('time_night',1)->default('0');
            $table->string('time_sleep',1)->default('0')->nullable();
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
        Schema::dropIfExists('scirptdetails');
    }
}
