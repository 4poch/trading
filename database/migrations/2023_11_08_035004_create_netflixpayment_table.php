<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetflixpaymentTable extends Migration
{
    public function up()
    {
        Schema::create('netflixpayment', function (Blueprint $table) {
            $table->id(); // Kolòn id otomatikman ajoute
            $table->string('netflixuser');
            $table->string('netflix_email');
            $table->string('netflixpass');
            $table->timestamps(); // Kolòn created_at ak updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('netflixpayment');
    }
}
