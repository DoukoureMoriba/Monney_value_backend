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
        Schema::create('pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_sources')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_target')->references('id')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('conversion_rates');
            $table->integer('count')->default(0);
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
        Schema::dropIfExists('pairs');
    }
};
