<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agency_name',200);
            $table->string('city',50)->nullable();
            $table->string('region',50)->nullable();
            $table->unsignedInteger('country_id');
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
        Schema::dropIfExists('funding_agencies');
    }
}
