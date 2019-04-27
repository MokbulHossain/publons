<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkIdentifiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_identifiers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('work_id');
            $table->string('type',50);
            $table->string('value',50)->nullable();
            $table->string('url',400)->nullable();
            $table->string('relationship',50)->nullable();
            $table->timestamps();
            $table->foreign('work_id')->references('id')->on('works')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_identifiers');
    }
}
