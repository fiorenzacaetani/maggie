<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shopping_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained('products')->nullOnDelete();
            $table->string('custom_name')->nullable();
            $table->float('quantity')->nullable();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->enum('source', ['auto', 'manual'])->default('manual');
            $table->enum('status', ['pending', 'bought'])->default('pending');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Un prodotto con product_id non può comparire due volte come "pending"
            $table->unique(['product_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shopping_list');
    }
};
