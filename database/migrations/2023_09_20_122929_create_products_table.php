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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sku');
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('department_id')->nullable();
            $table->string('Challan_num')->nullable();
            $table->integer('quantity')->nullable();
            $table->text('description')->nullable();
            $table->text('usp')->nullable();
            $table->text('invoice_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
