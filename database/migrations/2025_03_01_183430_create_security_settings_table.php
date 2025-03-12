<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('security_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('allow_user_registration')->default(true);
            $table->boolean('require_strong_passwords')->default(true);
            $table->boolean('enable_2fa')->default(false);
            $table->integer('session_timeout')->default(30); // in minutes
            $table->boolean('login_alerts')->default(false);
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_settings');
    }
};
