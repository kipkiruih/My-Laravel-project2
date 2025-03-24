<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Tenant who posted the review
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Reviewed property
            $table->tinyInteger('rating')->unsigned(); // Rating (1-5)
            $table->text('review')->nullable(); // Review content
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
