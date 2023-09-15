<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name_prefix');
            $table->string('first_name');
            $table->string('middle_initial');
            $table->string('last_name');
            $table->string('gender');
            $table->string('email');
            $table->date('date_of_birth');
            $table->time('time_of_birth');
            $table->string('age_in_years');
            $table->date('date_of_joining');
            $table->string('age_in_company');
            $table->string('phone_no');
            $table->string('place_name');
            $table->string('county');
            $table->string('city');
            $table->integer('zip');
            $table->string('region');
            $table->string('user_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
