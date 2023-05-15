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
        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('functionality_id')->nullable()->after('name');
            $table->foreign('functionality_id')
            ->references('id')
            ->on('functionalities')
            ->onDelete('set null');
        });

        Schema::table('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_id')->nullable()->after('functionality_id');
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
        Schema::table('permissions', function (Blueprint $table) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->dropForeign(['functionality_id']);
                $table->dropColumn('functionality_id');
                $table->dropForeign(['menu_id']);
                $table->dropColumn('menu_id');
            });
        });
    }
};
