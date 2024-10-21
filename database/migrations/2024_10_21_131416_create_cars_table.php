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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->double('price');
            $table->string('name'); // Corrected from varchar to string
            $table->unsignedBigInteger('marker_id');
            $table->unsignedBigInteger('model_id');
            $table->foreign('marker_id')->references('id')->on('markers')->onDelete('cascade');
            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
            $table->year('year');
            $table->integer('vin')->unique(); // Corrected from int to integer
            $table->double('mileage');
            $table->unsignedBigInteger('carType_id'); // Ensure this matches your car types table
            $table->foreign('carType_id')->references('id')->on('car_types')->onDelete('cascade');
            $table->unsignedBigInteger('fuel_id');
            $table->foreign('fuel_id')->references('id')->on('fuels')->onDelete('cascade');
            $table->text('address');
            $table->text('description');
            $table->text('car_specifications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['marker_id']);
            $table->dropForeign(['model_id']);
            $table->dropForeign(['carType_id']);
            $table->dropForeign(['fuel_id']);
        });

        Schema::dropIfExists('cars');
    }
};
