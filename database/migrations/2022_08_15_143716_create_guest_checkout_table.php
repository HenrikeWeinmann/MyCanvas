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
        Schema::create('guest_checkout', function (Blueprint $table) {
            $table->id();
            $table->foreignId('image_id');
            $table->integer('qty');
            $table->foreignId('user_id');
            $table->timestamps();
            $table->string('title'); //title
            $table->string('artist');
            $table->integer('sold')->nullable();
            $table->text('image_path');
            $table->decimal('price', $precision = 8, $scale = 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guest_checkout');
    }
};
