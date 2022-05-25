<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Load extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loads', function (Blueprint $table) {

        $table->id();            
        $table->string('name');
        $table->string('from_address');
        $table->string('to_address');
        $table->date('date');
        $table->string('from_state');
        $table->string('to_state');
        $table->string('from_district');
        $table->string('to_district');
        $table->string('from_lat');
        $table->string('from_lng');
        $table->string('to_lat');
        $table->string('to_lng');
        $table->string('to_place_id');
        $table->string('from_place_id');
        $table->string('distance');
        $table->string('time');
        $table->int('admin_id')->default(-1);

        $table->string('status')->default('view');
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
        //
    }
}
