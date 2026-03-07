<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supermarket_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('retailer_name', 50);
            $table->string('external_sku', 255)->index();
            $table->string('external_name', 255)->nullable();
            $table->string('external_unit', 50)->nullable();
            $table->decimal('external_price', 10, 2)->nullable();
            $table->enum('match_type', ['AUTO', 'MANUAL'])->default('AUTO');
            $table->timestamp('last_seen_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supermarket_mappings');
    }
};
