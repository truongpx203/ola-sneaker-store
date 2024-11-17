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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->string('name'); // Họ tên
            $table->string('email'); // Email
            $table->string('subject')->nullable(); // Tiêu đề
            $table->text('message'); // Nội dung
            $table->boolean('is_resolved')->default(false); // Đã phản hồi hay chưa
            $table->timestamps(); //Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
