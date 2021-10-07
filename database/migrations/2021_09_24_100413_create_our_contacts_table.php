<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_contacts', function (Blueprint $table) {
            $table->id();
            $table->text('address');
            $table->string('telephone');
            $table->string('email', 45);
            $table->string('link_address');
            $table->unsignedInteger('user_id');
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
        Schema::dropIfExists('our_contacts');
    }
}
