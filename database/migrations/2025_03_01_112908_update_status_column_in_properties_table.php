<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('properties', function (Blueprint $table) {
            $table->enum('status', ['Available', 'Rented', 'Sold', 'Pending', 'Approved', 'Rejected'])
                  ->default('Available')
                  ->change();
        });
    }

    public function down() {
        Schema::table('properties', function (Blueprint $table) {
            // Rollback to the previous ENUM values
            $table->enum('status', ['Available', 'Rented', 'Sold'])
                  ->default('Available')
                  ->change();
        });
    }
};

