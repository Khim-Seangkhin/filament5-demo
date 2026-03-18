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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();          // ads name
            $table->string('photo');                      // banner image
            $table->string('url')->nullable();            // link when click
            $table->string('position');                   // popup, header, sidebar, footer...
            $table->boolean('is_active')->default(true);  // enable/disable
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable(); 
            $table->integer('priority')->default(0);      // order / sort
            $table->integer('views')->default(0);         // count views
            $table->integer('clicks')->default(0);        // count clicks
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
