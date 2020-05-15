<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrationForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('tickets', function($table) {
             $table->unsignedBigInteger('userId');
             $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

             //$table->foreign('user_id')->references('id')->on('users');
             //$table->foreign('name')->references('email')->on('users');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
