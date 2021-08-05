<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugcodesTable extends Migration
{
    /**
     * Run the migrations.
     * 50%之後處理
     * @return void
     */
    public function up()
    {
        Schema::create('drugcodes', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('text');
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
        Schema::dropIfExists('drugcodes');
    }
}
