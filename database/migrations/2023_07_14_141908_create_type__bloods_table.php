<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeBloodsTable extends Migration
{
    // ++++++++++++ up() ++++++++++++
    public function up()
    {
        Schema::create('type__bloods', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->timestamps();
        });
    }
    // ++++++++++++ down() ++++++++++++
    public function down()
    {
        Schema::dropIfExists('type__bloods');
    }
}
