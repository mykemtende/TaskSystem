<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('department_id')->unsigned();
            $table->integer('access_level_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('duedate')->unsigned();
            $table->integer('priority')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->longText('description')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('tasks');
    }
}
