<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSivrApiCompareTable extends Migration
{
    public function up()
    {
        Schema::create('sivr_api_compare', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id')->nullable();
            $table->unsignedBigInteger('element_id')->nullable();
            $table->foreign('page_id')->on('sivr_pages')->references('id')->cascadeOnDelete();
            $table->foreign('element_id')->on('sivr_page_elements')->references('id')->cascadeOnDelete();
            $table->text('api_key')->nullable();
            $table->char('comparison', 3)->nullable();
            $table->text('key_value');
            $table->text('transfer_option');
            $table->char('transfer_page_id', 10)->nullable();
            $table->char('goto_page_id', 10)->nullable();
            $table->char('back_page_id', 10)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sivr_api_compare');
    }
}
