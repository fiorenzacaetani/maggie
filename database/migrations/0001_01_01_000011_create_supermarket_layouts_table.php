<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supermarket_layouts', function (Blueprint $table) {
            $table->id();
            $table->string('retailer_name', 100);
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->unsignedSmallInteger('aisle_order');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Un supermercato non può avere due ordini per la stessa categoria
            $table->unique(['retailer_name', 'category_id']);
            $table->index('retailer_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supermarket_layouts');
    }
};
