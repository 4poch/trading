<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcceptedByUserToOffersTable extends Migration
{
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->unsignedBigInteger('accepted_by_user_id')->nullable();
            $table->foreign('accepted_by_user_id')->references('id')->on('users');
            
        });
    }

    public function down()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->dropForeign(['accepted_by_user_id']);
            $table->dropColumn('accepted_by_user_id');
        });
    }
}