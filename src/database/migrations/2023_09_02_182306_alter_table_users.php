<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('username')->unique();
            $table->string('rol')->default('customer'); //admin or customer.
            $table->integer('balance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
