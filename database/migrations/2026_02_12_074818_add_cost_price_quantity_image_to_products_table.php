<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->decimal('cost', 10, 2)->after('sub_category_id');
        $table->decimal('price', 10, 2)->after('cost');
        $table->integer('quantity')->after('price');
        $table->string('image')->nullable()->after('quantity');
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['cost', 'price', 'quantity', 'image']);
    });
}

};
