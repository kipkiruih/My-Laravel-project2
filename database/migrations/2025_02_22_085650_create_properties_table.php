<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('location');
            $table->enum('property_type', ['Apartment', 'Commercial', 'House', 'Land']);
            $table->enum('status', ['Available', 'Rented', 'Sold'])->default('Available');
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false); // Featured property

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
