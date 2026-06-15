<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
            $table->string('cover_image')->nullable()->after('logo_url');
            $table->text('screenshots')->nullable()->after('cover_image'); // JSON array
            $table->string('tech_stack')->nullable()->after('features');  // comma-separated
        });
    }
    public function down(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['category','cover_image','screenshots','tech_stack']);
        });
    }
};
