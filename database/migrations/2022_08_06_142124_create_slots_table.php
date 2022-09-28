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

        // Schema::create('services', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('employee_id')->nullable()->references('id')->on('employees');
        //     $table->string('title');
        //     $table->boolean('enabled')->default(true);
        //     $table->integer('slot_interval_in_minutes');
        //     $table->timestamps();
        // });
        Schema::create('slots', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->foreignId('employee_id')->nullable()->references('id')->on('employees');
            $table->string('status');
            $table->unique(['date_from', 'date_to', 'employee_id']);
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
        Schema::dropIfExists('slots');
        Schema::dropIfExists('services');
    }
};
