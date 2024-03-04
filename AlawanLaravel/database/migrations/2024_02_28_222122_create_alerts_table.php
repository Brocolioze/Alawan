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
        Schema::create('alert', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained();
            $table->date('dateLost');
            $table->date('dateFind')->nullable();
            $table->String('place')->nullable();
            $table->text('description')->nullable();
            $table->boolean('alertFound');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert');
    }
};
