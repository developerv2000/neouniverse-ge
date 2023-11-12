<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('ru_title')->unique();
            $table->string('en_title');
            $table->string('ka_title');

            $table->string('url')->unique();

            $table->string('ru_image');
            $table->string('en_image');
            $table->string('ka_image');

            $table->text('ru_body');
            $table->text('en_body');
            $table->text('ka_body');
            
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
        Schema::dropIfExists('news');
    }
}
