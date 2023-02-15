<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profession_translations', function (Blueprint $table) {
            $table->id();

            $table->integer('profession_id')->unsigned();
            $table->string('name');
            $table->string('locale')->index();
            $table->timestamps();

            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profession_translations');
    }
};
