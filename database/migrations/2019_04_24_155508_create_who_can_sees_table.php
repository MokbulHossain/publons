<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhoCanSeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('who_can_sees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table_name',50);
            $table->unsignedInteger('table_primarykey_id');
            $table->string('table_field_name',50)->nullable();
            $table->tinyInteger('everyone')->default(0);
            $table->tinyInteger('trusted_parties')->default(0);
            $table->tinyInteger('only_me')->default(0);
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
        Schema::dropIfExists('who_can_sees');
    }
}
