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
    Schema::table('users', function ($table) {
        $table->string('firstname')->after('id');
        $table->string('lastname')->after('firstname');
        $table->tinyInteger('is_verified')->default(0)->after('password');
        $table->string('verify_token', 64)->nullable()->after('is_verified');
    });
}

public function down()
{
    Schema::table('users', function ($table) {
        $table->dropColumn(['firstname', 'lastname', 'is_verified', 'verify_token']);
    });
}

};
