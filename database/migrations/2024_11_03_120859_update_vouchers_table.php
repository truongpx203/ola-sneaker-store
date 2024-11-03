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
        Schema::table('vouchers', function (Blueprint $table) {
            $table->integer('value')->change();
            $table->integer('max_price')->change();
            $table->unsignedBigInteger('for_user_ids')->nullable()->change();
            $table->foreign('for_user_ids')->references('id')->on('users')->onDelete('cascade');
            $table->enum('user_use', [
                'everybody',
                'male',
                'female',
            ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers', function (Blueprint $table) {
            $table->decimal('value', 10, 2)->change();
            $table->decimal('max_price', 10, 2)->change();
            $table->dropForeign(['for_user_ids']);
            $table->text('for_user_ids')->nullable()->change();

            $table->dropColumn('user_use');
        });
    }
};
