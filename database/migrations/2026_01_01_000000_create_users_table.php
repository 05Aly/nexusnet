<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('cover_image')->nullable();
            $table->text('bio')->nullable();
            $table->string('role')->default('user');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->string('followers_display')->default('1.2K');
            $table->string('following_display')->default('348');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
