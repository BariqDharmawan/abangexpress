<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingSectionTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_section_titles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('about_us')->nullable();
            $table->string('our_service')->nullable();
            $table->string('contact_us')->nullable();
            $table->string('our_team')->nullable();
            $table->string('our_branch')->nullable();
            $table->string('faq')->nullable();
            $table->string('our_contact')->nullable();
            $table->string('domain_owner')->unique();
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
        Schema::dropIfExists('landing_section_titles');
    }
}
