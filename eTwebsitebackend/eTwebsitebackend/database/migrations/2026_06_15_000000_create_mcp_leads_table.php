<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mcp_leads', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->nullable();
            $table->string('company')->nullable();
            $table->string('phone')->nullable();
            $table->string('service_interest')->nullable();
            $table->string('budget_range')->nullable();
            $table->longText('conversation_summary')->nullable();
            $table->enum('platform_source', [
                'chatgpt',
                'tencent',
                'claude',
                'slack',
                'github',
                'web'
            ])->default('mcp-server');
            $table->enum('status', [
                'new',
                'contacted',
                'qualified',
                'proposal',
                'converted',
                'rejected'
            ])->default('new');
            $table->integer('lead_score')->default(0);
            $table->string('mcp_session_id')->nullable();
            $table->timestamp('last_contacted_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('platform_source');
            $table->index('status');
            $table->index('created_at');
            $table->index('lead_score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcp_leads');
    }
};
