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
            $table->string('about_us');
            $table->string('our_service');
            $table->string('contact_us');
            $table->string('our_team');
            $table->string('our_branch');
            $table->string('faq');
            $table->string('our_contact');
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
