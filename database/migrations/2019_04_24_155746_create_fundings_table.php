<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFundingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fundings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('type',50);
            $table->string('subtype',100)->nullable();
            $table->string('project_title',400);
            $table->string('translated_title',400)->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->string('description',3000)->nullable();
            $table->unsignedInteger('amount');
            $table->string('p_start_year',4)->nullable();
            $table->string('p_start_month',2)->nullable();
            $table->string('p_end_year',4)->nullable();
            $table->string('p_end_month',2)->nullable();
            $table->unsignedInteger('funding_agency_id');
            $table->string('alternative_url',500)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fundings');
    }
}
