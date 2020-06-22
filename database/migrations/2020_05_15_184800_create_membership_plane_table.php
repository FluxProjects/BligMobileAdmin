<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipPlaneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_plane', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->string('membership_name');
            $table->string('membership_duration');
            $table->string('membership_description');
            $table->string('membership_cost');
            $table->integer('role_group_id');
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
        Schema::dropIfExists('membership_plane');
    }
}
