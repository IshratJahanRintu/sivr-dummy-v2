<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSivrPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sivr_pages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('parent_page_id')->nullable();
            $table->foreign('parent_page_id')->on('sivr_pages')->references('id')->cascadeOnDelete();
            $table->unsignedBigInteger('vivr_id')->nullable();
            $table->text('page_heading_ban');
            $table->text('page_heading_en');
            $table->text('task');
            $table->char('has_previous_menu',1)->default('N');
            $table->char('has_main_menu',1)->default('N');
            $table->text('audio_file_ban')->nullable();
            $table->text('audio_file_en')->nullable();
            $table->char('service_title_id',10)->nullable();
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
        Schema::dropIfExists('sivr_pages');
    }
}
