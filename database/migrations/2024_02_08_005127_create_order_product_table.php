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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade')->onUpdate("cascade");
            $table->foreignId('product_id')->constrained()->onDelete('cascade')->onUpdate("cascade");
            $table->integer('quantity')->unsigned();
            $table->decimal('price', 12, 2)->unsigned()->index();
            $table->decimal('shipping_price', 8, 2)->default(0)->unsigned()->index();
            $table->decimal('total_price',12,2)->unsigned()->index();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
