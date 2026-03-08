<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('inventory_logs', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('source');
        });

        Schema::table('pantry', function (Blueprint $table) {
            $table->index('current_quantity_base');
        });

        Schema::table('ai_interactions_logs', function (Blueprint $table) {
            $table->index('created_at');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::table('inventory_logs', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['source']);
        });

        Schema::table('pantry', function (Blueprint $table) {
            $table->dropIndex(['current_quantity_base']);
        });

        Schema::table('ai_interactions_logs', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });
    }
};
