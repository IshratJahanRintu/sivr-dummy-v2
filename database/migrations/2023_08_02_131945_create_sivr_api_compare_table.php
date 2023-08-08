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
            $table->char('page_id', 10)->default('');
            $table->char('element_id', 10)->default('');
            $table->text('api_key');
            $table->char('comparison', 3)->default('');
            $table->text('key_value');
            $table->text('transfer_option');
            $table->char('transfer_page_id', 10)->default('');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sivr_api_compare');
    }
}
