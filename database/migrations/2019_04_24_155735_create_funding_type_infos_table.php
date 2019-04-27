<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingTypeInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funding_type_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('funding_id');
            $table->string('number',50);
            $table->string('url',400);
            $table->string('relationship',20);
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
        Schema::dropIfExists('funding_type_infos');
    }
}
