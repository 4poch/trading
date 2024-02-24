<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNouvoprosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nouvopros', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users');
        $table->string('service');
        $table->string('website_link')->default('');
        $table->string('website_info')->default(''); // Ajout d'une valeur par défaut
        $table->integer('quantity');
        $table->string('estimate_value');
        $table->text('order_description');
        $table->boolean('policy_accepted')->default(false); // Ajout d'une valeur par défaut
        $table->timestamps();
        $table->enum('status', ['Pending', 'Rejected', 'Complete'])->default('Pending');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nouvopros');
    }
}
