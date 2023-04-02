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
        Schema::create('members', function(Blueprint $table){
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('address');
            $table->string('sex');
            $table->date('DOB');
            $table->string('plan');
            $table->string('type');
            $table->string('image');
            $table->string('age');
            $table->string('mobilenum');
            $table->string('email');
            $table->string('password');
            $table->boolean('approved')->default(value: 0)->nullable();
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
        //
    }
};
