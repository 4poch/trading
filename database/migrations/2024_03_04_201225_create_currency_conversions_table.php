<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_conversions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Ajout de la colonne pour l'ID de l'utilisateur
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('user_email'); // Ajout de la colonne pour l'email de l'utilisateur
            $table->string('currency_from');
            $table->string('currency_to');
            $table->decimal('amount', 10, 2);
            $table->decimal('converted_amount', 10, 2)->nullable();
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
        Schema::dropIfExists('currency_conversions');
    }
}


