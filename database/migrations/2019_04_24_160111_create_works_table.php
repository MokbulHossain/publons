<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('work_category_id');
            $table->string('title',400);
            $table->string('translated_title',400)->nullable();
            $table->unsignedInteger('t_language_id')->nullable();
            $table->string('subtitle',400)->nullable();
            $table->string('journal_title',400)->nullable();
            $table->string('publication_year',4)->nullable();
            $table->string('publication_month',2)->nullable();
            $table->string('publication_date',2)->nullable();
            $table->unsignedInteger('citation_type_id')->nullable();
            $table->string('citation',400)->nullable();
            $table->string('description',400)->nullable();
            $table->string('DOI',100)->nullable();
            $table->string('EDI',100)->nullable();
            $table->unsignedInteger('language_id')->nullable();
            $table->unsignedInteger('country_id')->nullable();
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
        Schema::dropIfExists('works');
    }
}
