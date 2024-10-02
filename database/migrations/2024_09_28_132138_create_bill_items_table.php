<?php

use App\Models\Bill;
use App\Models\Product;
use App\Models\Variant;
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
        Schema::create('bill_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Variant::class)->constrained();
            $table->foreignIdFor(Bill::class)->constrained();
            $table->decimal('sale_price', 10, 2);
            $table->decimal('listed_price', 10, 2);
            $table->decimal('import_price', 10, 2);
            $table->integer('variant_quantity');
           
            $table->string('product_name');
            $table->string('product_image_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_items');
    }
};
