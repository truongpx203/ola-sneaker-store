<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('value', 10, 2);
            $table->text('description');
            $table->decimal('max_price', 10, 2);
            $table->timestamp('start_datetime');
            $table->timestamp('end_datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('quantity');
            $table->integer('used_quantity')->default(0);
            $table->text('for_user_ids')->nullable();
            $table->timestamps();
        });       
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
