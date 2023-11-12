<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();

            $table->string('ru_title');
            $table->string('en_title');
            $table->string('ka_title');

            $table->integer('product_id');
            $table->string('url'); // used only in Helper`s uploadFile function (to escape errors)
            
            $table->string('ru_image');
            $table->string('en_image');
            $table->string('ka_image');

            $table->text('ru_description');
            $table->text('en_description');
            $table->text('ka_description');

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
        Schema::dropIfExists('carousels');
    }
}
