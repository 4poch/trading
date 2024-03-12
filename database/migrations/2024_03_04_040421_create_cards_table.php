<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('cards', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('user_name'); 
        $table->string('user_email');
        $table->string('card');
        $table->decimal('amount', 10, 2);
        $table->string('card_number')->nullable();
        $table->string('expiration_date')->nullable();
        $table->string('cvv')->nullable();
        $table->enum('status', ['pending', 'rejected', 'complete'])->default('pending');
        $table->timestamps();
    });
    
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
