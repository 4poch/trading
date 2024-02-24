<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    public function up()
{
    Schema::create('offers', function (Blueprint $table) {
        $table->id();
        $table->string('type_Offer');
        $table->decimal('Amount', 10, 2);
        $table->decimal('Cost_value', 10, 2);
        $table->unsignedBigInteger('user_id');
        $table->boolean('policy_agreement');
        $table->string('crypto_address')->nullable(); // Ajoute sa a san mete "after"
        $table->boolean('accepted')->default(false);
        $table->boolean('approved')->default(false);
        $table->unsignedBigInteger('approved_by_user_id')->nullable();
        
        
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('offers');
    Schema::table('offers', function (Blueprint $table) {
        $table->dropColumn(['approved', 'approved_by_user_id']);
    });
}

}