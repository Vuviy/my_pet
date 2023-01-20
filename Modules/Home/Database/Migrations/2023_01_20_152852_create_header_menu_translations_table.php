<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('header_menu_translations', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('header_menu_id')->unsigned();
                $table->string('locale')->index();
                $table->string('title');

                $table->foreign('header_menu_id')->references('id')->on('header_menus')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_menu_translations');
    }
};
