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
        Schema::create('animal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained();
            $table->foreignId('race_id')->constrained();
            $table->foreignId('necklace_id')->constrained();
            $table->String('name');
            $table->String('picture');
            $table->date('birth');
            $table->boolean('research');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal');
    }
};
