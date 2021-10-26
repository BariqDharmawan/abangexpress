<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->increments('id');
            $table->string('our_name', 20);
            $table->string('our_vision');
            $table->text('our_mission');
            $table->string('our_video')->nullable();
            $table->text('address_embed')->nullable();
            $table->string('slogan');
            $table->string('sub_slogan')->nullable();
            $table->string('cover_vision_mission')->nullable();
            $table->string('domain_owner');
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
        Schema::dropIfExists('about_us');
    }
}
