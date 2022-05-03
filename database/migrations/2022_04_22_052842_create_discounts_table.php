<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->comment('Mã giảm giá');
            $table->string('discount')->comment('Giá giảm');
            $table->integer('limit_number')->comment('Giới hạn lượt mua');
            $table->integer('number_used')->default(0)->comment('Số lượt đã dùng');
            $table->integer('payment_limit')->comment('Giá trị đơn hàng tối thiểu');
            $table->dateTime('expiration_date')->comment('Ngày hết hạn');
            $table->string('description')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts');
    }
};
