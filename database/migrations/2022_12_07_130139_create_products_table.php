<?php

use App\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('barcode')->nullable();
            $table->string('material')->nullable();
            $table->string('title')->nullable();
            $table->string('size')->nullable();
            $table->string('background_color')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default(Status::Active->value)->nullable();
            $table->text('description')->nullable();
            $table->text('description_for_worker')->nullable();
            $table->text('keywords_for_search')->nullable();
            $table->integer('order')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('order_quantity')->nullable();
            $table->integer('alert_min_count')->default(50);
            $table->boolean('stock_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
