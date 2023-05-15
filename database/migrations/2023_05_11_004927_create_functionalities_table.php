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
        Schema::create('functionalities', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            // $table->string('des_link');
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->timestamps();
            $table->foreign('menu_id')
            ->references('id')
            ->on('menus')
            ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('functionalities');
    }
};
