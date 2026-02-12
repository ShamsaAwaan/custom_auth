<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // Add missing columns
            $table->string('sku')->unique()->after('name');
            $table->foreignId('category_id')->constrained()->after('sku');
            $table->integer('quantity')->default(0)->after('price');
            $table->string('image')->nullable()->after('quantity');

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sku','category_id','quantity','image']);
        });
    }
};

