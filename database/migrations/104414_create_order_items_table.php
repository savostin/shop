<?php

use App\Models\Enums\VariationColourEnum;
use App\Models\Enums\VariationSizeEnum;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->string('product')->max(255);
            $table->string('size')->max(10);
            $table->string('colour')->max(10);
            $table->unsignedInteger('qty')->default(1);
            $table->unsignedDecimal('price', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
