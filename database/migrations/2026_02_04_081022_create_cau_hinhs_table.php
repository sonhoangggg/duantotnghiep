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
        Schema::create('cau_hinhs', function (Blueprint $table) {
            $table->id();
            $table->string('khoa',100)->unique();
            $table->string('gia_tri');
            $table->string('mo_ta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cau_hinhs');
    }
};
