<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSivrPageElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sivr_page_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id')->nullable();
            $table->foreign('page_id')->on('sivr_pages')->references('id')->cascadeOnDelete();
            $table->string('type', 20);
            $table->text('display_name_bn')->nullable();
            $table->text('display_name_en')->nullable();
            $table->char('background_color', 7);
            $table->char('text_color', 7);
            $table->json('element_properties')->nullable();
            $table->integer('element_order');
            $table->char('is_visible', 1)->default('Y');
            $table->text('data_provider_function')->nullable();
            $table->text('menu_icon')->nullable();
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
        Schema::dropIfExists('sivr_page_elements');
    }
}
