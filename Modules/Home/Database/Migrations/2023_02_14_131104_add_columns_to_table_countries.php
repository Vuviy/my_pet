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
        Schema::table('countries', function (Blueprint $table) {
            $table->integer('cost_live')->after('status')->nullable();
            $table->integer('rent')->after('cost_live')->nullable();
            $table->integer('square_meter')->after('rent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {

            $table->dropColumn('cost_live');
            $table->dropColumn('rent');
            $table->dropColumn('square_meter');
        });
    }
};
