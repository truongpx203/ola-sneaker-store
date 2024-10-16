<?php

use App\Models\Bill;
use App\Models\User;
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
        Schema::create('bill_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Bill::class)->constrained()->onDelete('cascade');
            $table->foreignId('by_user')->constrained('users')->onDelete('cascade');

            // Sử dụng enum cho trạng thái
            $table->enum('from_status', [
                'pending',
                'confirmed',
                'in_delivery',
                'delivered',
                'failed',
                'canceled',
                'completed'
            ]);
            $table->enum('to_status', [
                'pending',
                'confirmed',
                'in_delivery',
                'delivered',
                'failed',
                'canceled',
                'completed'
            ]);
            $table->text('note')->nullable();
            $table->timestamp('at_datetime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_histories');
    }
};
