<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Enums\CartStatusEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

return new class extends Migration
{
    use HasUuids;
    
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('user_id')->nullable()->default(null)->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', CartStatusEnum::values())->default(CartStatusEnum::CREATED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
