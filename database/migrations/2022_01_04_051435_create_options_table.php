<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('key'); // used to store more readable block name (used in dashboard)
            $table->text('ru_value');
            $table->text('en_value');
            $table->text('ka_value');
            $table->string('tag')->unique(); // identificator of element (used by developer)
            $table->string('group')->nullable();  // some options may have same groups
            $table->boolean('wysiwyg')->default(false); // simditor/textarea switcher
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
        Schema::dropIfExists('options');
    }
}
