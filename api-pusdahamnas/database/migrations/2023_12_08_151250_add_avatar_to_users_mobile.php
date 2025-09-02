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
        Schema::table('users_mobile', function (Blueprint $table) {
            $table->string('image_foto')->nullable();
            $table->string('verification_code');
            $table->boolean('is_verified')->default(0);
            $table->string('bidang')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_mobile', function (Blueprint $table) {
            //
        });
    }
};
