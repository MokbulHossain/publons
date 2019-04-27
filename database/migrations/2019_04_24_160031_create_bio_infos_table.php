<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBioInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('type',50);
            $table->unsignedInteger('organization_id');
            $table->string('department',100)->nullable();
            $table->string('role_title',100)->nullable();
            $table->string('url',400)->nullable();
            $table->string('start_year',4)->nullable();
            $table->string('start_month',2)->nullable();
            $table->string('start_date',2)->nullable();
            $table->string('end_year',4)->nullable();
            $table->string('end_month',2)->nullable();
            $table->string('end_date',2)->nullable();
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
        Schema::dropIfExists('bio_infos');
    }
}
