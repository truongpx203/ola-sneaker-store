<?php

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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('code')->unique();
            $table->enum('bill_status', [
                'pending',                 // Chờ xác nhận
                'confirmed',               // Đã xác nhận
                'in_delivery',             // Đang giao
                'delivered',               // Giao hàng thành công
                'failed',                  // Giao hàng thất bại
                'canceled',                // Đã hủy
                'completed'                // Hoàn thành
            ]);
            $table->enum('payment_type', ['cod', 'vnpay', 'momo']); // Loại thanh toán
            $table->enum('payment_status', ['pending', 'completed']); // Trạng thái thanh toán
            $table->decimal('total_price', 15, 2);
            $table->string('full_name');
            $table->string('phone_number');
            $table->text('address');
            $table->text('note')->nullable();

            // Thêm các trường để lưu trữ điểm và giảm giá (24/11/2024)
            $table->integer('points_used')->default(0);  // Điểm đã sử dụng
            $table->decimal('discount_amount', 8, 2)->default(0); // Giá trị giảm giá
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
