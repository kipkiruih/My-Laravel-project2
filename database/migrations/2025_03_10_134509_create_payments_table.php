<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained('users')->onDelete('cascade'); // Tenant who made the payment
            $table->foreignId('property_id')->constrained()->onDelete('cascade'); // Property being paid for
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade'); // Owner of the property
            $table->string('transaction_id')->unique(); // Payment transaction reference
            $table->decimal('amount', 10, 2); // Payment amount
            $table->date('due_date'); // Due date for payment
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};

