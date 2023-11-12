<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('ru_name')->unique();
            $table->string('en_name');
            $table->string('ka_name');

            $table->string('url')->unique();
            $table->boolean('prescription'); //RX or OTC
            $table->boolean('highlight_in_filter')->default(0);
            $table->integer('form_id');
            
            $table->string('ru_image');
            $table->string('en_image');
            $table->string('ka_image');

            $table->string('ru_instruction');
            $table->string('en_instruction');
            $table->string('ka_instruction');

            $table->string('ru_obtain_link')->nullable();
            $table->string('en_obtain_link')->nullable();
            $table->string('ka_obtain_link')->nullable();

            $table->text('ru_amount'); //10 tablets, 5 ml etc
            $table->text('en_amount');
            $table->text('ka_amount');

            $table->text('ru_description');
            $table->text('en_description');
            $table->text('ka_description');

            $table->text('ru_composition');
            $table->text('en_composition');
            $table->text('ka_composition');

            $table->text('ru_testimony');
            $table->text('en_testimony');
            $table->text('ka_testimony');

            $table->text('ru_use');
            $table->text('en_use');
            $table->text('ka_use');

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
        Schema::dropIfExists('products');
    }
}
