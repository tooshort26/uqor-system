<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampusFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campus_form', function (Blueprint $table) {
            $table->integer('campus_id');
            $table->integer('form_id');
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->timestamps();
            $table->primary(['campus_id', 'form_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campus_form');
    }
}
