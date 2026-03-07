<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->string('ean', 13)->unique()->nullable();
            $table->string('brand', 100)->nullable();
            $table->string('name', 255);
            $table->foreignId('base_unit_id')->constrained('units');
            $table->float('content_value')->nullable();
            $table->timestamps();
        });

        Schema::create('product_aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('alias_name', 255)->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_aliases');
        Schema::dropIfExists('products');
    }
};
