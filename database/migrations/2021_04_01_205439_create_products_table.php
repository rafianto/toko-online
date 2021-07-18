<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->unsignedBigInteger('user_id')->nullable(true);
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('sku')->unique();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->integer('price', 15, 2)->autoIncrement(false)->nullable($value = false);
            $table->decimal('weight', 10, 2)->nullable($value = false);
            $table->decimal('width', 10, 2)->nullable($value = true);
            $table->decimal('height', 10, 2)->nullable($value = true);
            $table->decimal('length', 10, 2)->nullable($value = true);
            $table->text('short_description')->nullable($value = true);
            $table->text('description')->nullable($value = true);
            $table->integer('status');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable($value = true)->default(null);
            $table->index(['sku', 'slug']);
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
}
