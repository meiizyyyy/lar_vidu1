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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id'); // Thay đổi tên cột cho ID của cart_item
            $table->unsignedBigInteger('cart_id'); // ID của giỏ hàng
            $table->unsignedBigInteger('product_id'); // ID của sản phẩm
            $table->integer('quantity')->default(1); // Số lượng sản phẩm trong giỏ
            $table->timestamps();

            // Khóa ngoại cho cart_id tham chiếu đến id trong bảng carts
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');

            // Khóa ngoại cho product_id tham chiếu đến product_id trong bảng products
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
