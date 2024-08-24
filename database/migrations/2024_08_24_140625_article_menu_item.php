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
        Schema::create('article_menu_item', function (Blueprint $table) {
            // Remove $table->id(); if it was there

            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('menu_item_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');

            // Composite primary key
            $table->primary(['article_id', 'menu_item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_menu_item');
    }
};
