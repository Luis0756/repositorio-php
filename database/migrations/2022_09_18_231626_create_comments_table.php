<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {

            $table->id();

            $table->string("usuario");
            $table->string("descricao");

            $table->unsignedBigInteger("fk_postagem_id");
            $table->foreign("fk_postagem_id")->references("id")->on("posts");

            $table->timestamps(); 
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
