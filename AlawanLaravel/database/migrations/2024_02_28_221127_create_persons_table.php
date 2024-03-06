<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    use Illuminate\Support\Facades\Hash;
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained();
            $table->String('name');
            $table->String('lastName');
            $table->String('email')->unique();
            $table->string('password')->hash();
            $table->String('phone');
            $table->boolean('invite');
            $table->boolean('admin');
            $table->date('creationDate');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person');
    }
};
