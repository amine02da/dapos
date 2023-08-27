<?php

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
            $table->foreignid("category_id")->constraind("categories")->onDelete("cascade");
            $table->string("name");
            $table->text("description")->nullable();
            $table->string("image")->default("uploads/default.png");
            $table->decimal("purchase_price");
            $table->decimal("purchase_compare_price");
            $table->decimal("sale_price");
            $table->integer("quantity");
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
        Schema::dropIfExists('products');
    }
};
