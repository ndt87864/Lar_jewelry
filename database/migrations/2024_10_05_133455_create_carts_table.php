<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // id của người dùng
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // id của sản phẩm
            $table->string('name'); // tên sản phẩm
            $table->decimal('price', 10, 2); // giá sản phẩm
            $table->string('category'); // danh mục sản phẩm
            $table->string('image')->nullable(); // hình ảnh sản phẩm
            $table->integer('quantity'); // số lượng sản phẩm
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
