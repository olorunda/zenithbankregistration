<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('validated_users', function (Blueprint $table) {

            $table->id();
            $table->integer('ran')->index('idx_ran');
            $table->string('chn');
            $table->string('name');
            $table->string('holdings');
            $table->string('address');
            $table->string('phone_num');
            $table->string('emails');
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
        Schema::dropIfExists('validated_users');
    }
};
