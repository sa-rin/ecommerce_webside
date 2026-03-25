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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
             $table->string('CompanyName')->nullable();
            $table->string('Address')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Email')->nullable();
            $table->string('Facebook')->nullable();
            $table->string('Telegram')->nullable();
            $table->string('Youtube')->nullable();
            $table->string('Copyright')->nullable();
            $table->boolean('IsActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
