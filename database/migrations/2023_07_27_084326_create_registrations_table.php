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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('ran')->unique();
//            $table->string('company', 60);
            $table->string('reason_for_attending', 500);
            $table->string('master_classes', 500);
            $table->enum('attending_masterclass', ['yes', 'no'])->default('no');
            $table->enum('consent', ['yes', 'no'])->default('no');
            $table->enum('is_zenith_customer', ['yes', 'no'])->default('no');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
};
