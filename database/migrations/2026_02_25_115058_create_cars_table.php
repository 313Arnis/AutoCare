<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('razotajs');
            $table->string('modelis');
            $table->year('gads');

            $table->integer('nobraukums'); 

            $table->date('octa_beigas')->nullable();
            $table->date('tehniska_beigas')->nullable();

            $table->integer('pedeja_ella_km')->nullable();
            $table->integer('ellas_intervals_km')->default(10000);
            $table->integer('videjais_menes_km')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};