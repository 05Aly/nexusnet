<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('NexusNet');
            $table->string('welcome_title')->default('مرحباً بك في NexusNet');
            $table->text('welcome_subtitle')->nullable();
            $table->string('demo_banner_text')->default('وضع المعاينة التجريبي (Portfolio Demo) — تم ملء المنصة ببيانات تجريبية للعرض فقط');
            $table->text('quote_text')->nullable();
            $table->string('quote_author')->default('NexusNet');
            $table->string('stat_users')->default('1.2K');
            $table->string('stat_posts')->default('245');
            $table->string('stat_groups')->default('89');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
