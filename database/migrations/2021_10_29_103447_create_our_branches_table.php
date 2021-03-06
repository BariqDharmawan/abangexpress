<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_branches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('icon');
            $table->string('telephone', 36)->nullable();
            $table->mediumText('address');
            $table->string('domain_owner', 45);
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
        Schema::dropIfExists('our_branches');
    }
}
