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
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'status')) {
            $table->enum('status', ['active', 'deactivated'])->default('active')->after('profile_image');
        }
        if (!Schema::hasColumn('users', 'last_login')) {
            $table->timestamp('last_login')->nullable()->after('status');
        }
        if (!Schema::hasColumn('users', 'last_login_ip')) {
            $table->string('last_login_ip')->nullable()->after('last_login');
        }
        if (!Schema::hasColumn('users', 'last_login_agent')) {
            $table->text('last_login_agent')->nullable()->after('last_login_ip');
        }
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        if (Schema::hasColumn('users', 'status')) {
            $table->dropColumn('status');
        }
        if (Schema::hasColumn('users', 'last_login')) {
            $table->dropColumn('last_login');
        }
        if (Schema::hasColumn('users', 'last_login_ip')) {
            $table->dropColumn('last_login_ip');
        }
        if (Schema::hasColumn('users', 'last_login_agent')) {
            $table->dropColumn('last_login_agent');
        }
    });
}

};
