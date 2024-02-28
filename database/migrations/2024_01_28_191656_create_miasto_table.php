<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    //     Schema::create('miastos', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->string('nazwa');
    //         $table->string('wojewodztwo');
    //         $table->integer('kod_pocztowy');
    //         $table->string('img');
    //         $table->string('kraj');
    //         $table->timestamps();
    //     });

    //     Schema::create('families', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->unsignedInteger('miasto_id');
    //         $table->string('nazwisko');
    //         // $table->integer('ilosc_czlonkow');
    //         $table->timestamps();
    //         $table->foreign('miasto_id')
    //             ->references('id')
    //             ->on('miastos')
    //             ->onDelete('cascade');
    //     });

    //     Schema::create('persons', function (Blueprint $table) {
    //         $table->increments('id');
    //         $table->unsignedInteger('rodzina_id');
    //         $table->string('name');
    //         $table->string('surname');
    //         $table->bigInteger('pesel');
    //         $table->char('sex');
    //         $table->timestamps();
    //         $table->foreign('rodzina_id')
    //             ->references('id')
    //             ->on('families')
    //             ->onDelete('cascade');
    //     });
        
    }

   


    public function down(): void
    {
        Schema::dropIfExists('miastos');
    }
};
