<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pantry', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->float('current_quantity_base')->default(0);
            $table->float('min_threshold_base')->default(0);
            $table->float('avg_consumption_daily')->default(0);
            $table->dateTime('last_restock_date')->nullable();
        });

        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->float('change_amount_base');
            $table->enum('source', ['voice', 'receipt', 'manual', 'prediction', 'recipe_cooked']);
            $table->foreignId('ai_interaction_id')->nullable()->constrained('ai_interactions_logs')->nullOnDelete();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
        Schema::dropIfExists('pantry');
    }
};
