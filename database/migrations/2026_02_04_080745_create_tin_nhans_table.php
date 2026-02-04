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
        Schema::create('tin_nhans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuoc_tro_chuyen_id')->constrained('cuoc_tro_chuyens');
            $table->foreignId('nguoi_gui_id')->nullable()->constrained('nguoi_dungs');
            $table->enum('vai_tro_gui',['khach','admin','bot']);
            $table->text('noi_dung');
            $table->boolean('da_doc')->default(false);
            $table->timestamp('gui_luc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tin_nhans');
    }
};
