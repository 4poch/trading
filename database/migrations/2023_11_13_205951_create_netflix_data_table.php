<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetflixDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('netflix_data', function (Blueprint $table) {
            $table->id();
            $table->string('userId');
            $table->string('netflixLogin');
            $table->string('netflixPasscode');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('action');
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
        Schema::dropIfExists('netflix_data');
    }
}
