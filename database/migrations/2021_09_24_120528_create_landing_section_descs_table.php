<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingSectionDescsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_section_descs', function (Blueprint $table) {
            $table->increments('id');
            $table->text('first_desc_about_us');
            $table->text('second_desc_about_us')->nullable();
            $table->text('first_desc_contact_us')->nullable();
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
        Schema::dropIfExists('landing_section_descs');
    }
}
