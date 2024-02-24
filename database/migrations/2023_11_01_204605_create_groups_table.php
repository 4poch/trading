<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id(); // Kreye yon kolòn "id" ak kle primè
            $table->string('group_link'); // Kreye yon kolòn "group_link" ki se yon tèks
            $table->string('category'); // Kreye yon kolòn "category" ki se yon tèks
            $table->integer('user_amount'); // Kreye yon kolòn "user_amount" ki se yon antye
            $table->string('country'); // Kreye yon kolòn "country" ki se yon tèks
            $table->timestamps(); // Kreye de kolòn "created_at" ak "updated_at" ki kenbe dat ak lè yo kreye ak mete ajou tèks la.
        });
    }

    public function down()
    {
        Schema::dropIfExists('groups'); // Efase tablo a si ou vle retire li.
    }
}
