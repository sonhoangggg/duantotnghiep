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
        Schema::create('anh_hoan_tras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hoan_tra_id')->constrained('hoan_tras');
            $table->string('duong_dan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anh_hoan_tras');
    }
};
