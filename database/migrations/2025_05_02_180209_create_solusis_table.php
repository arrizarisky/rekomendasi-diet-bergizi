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
        Schema::create('solusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_penyakit')->constrained('penyakits')->onDelete('cascade');
            $table->text('saran');
            $table->text('solusi');
            $table->text('pantangan');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solusis');
    }
};
