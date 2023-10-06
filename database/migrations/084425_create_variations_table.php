<?php

use App\Models\Enums\VariationColourEnum;
use App\Models\Enums\VariationSizeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

return new class extends Migration
{
    use HasUuids;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('variations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedDecimal('price', 8, 2)->default(0);
            $table->string('image')->nullable()->default(null);
            $table->enum('size', VariationSizeEnum::values());
            $table->enum('colour', VariationColourEnum::values());
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
