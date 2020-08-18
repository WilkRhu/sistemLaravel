<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->increments("id");
            $table->integer('loja_id')->unsigned();
            $table->foreign("loja_id")->references("id")->on("loja")->onDelete('cascade')->onUpdate('cascade');
            $table->string("nome");
            $table->integer("valor");
            $table->boolean("ativo");
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
        Schema::dropIfExists('produto');
    }
}
