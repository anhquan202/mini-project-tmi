<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('u_id')->primary();
            $table->foreignId('status_id')->constrained('statuses');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->enum('gender', ['nam', 'nữ', 'khác'])->default('khác');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
