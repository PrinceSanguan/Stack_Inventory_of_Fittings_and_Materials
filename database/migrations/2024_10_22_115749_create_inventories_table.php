<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('reorder')->nullable();
            $table->string('inventory_no')->nullable()->unique()->index(); // Unique inventory number
            $table->string('category');
            $table->string('unit'); // pcs, box, each
            $table->string('description');
            $table->integer('beginning_balance'); // Initial stock count
            $table->integer('issuance'); // Items issued
            $table->integer('quantity'); // Current stock
            $table->decimal('unit_price', 10, 2); // Unit price of the item
            $table->decimal('inventory_value', 10, 2); // Calculated field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
