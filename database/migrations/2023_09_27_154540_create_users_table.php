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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->bigInteger('nip')->unique();
            $table->string('email')->unique()->nullable();
            $table->foreignId('work_place_id')->constrained(
                table: 'work_places',
            )->restrictOnUpdate()->restrictOnDelete();
            $table->text('image');
            $table->foreignId('status_id')->constrained(
                table: 'statuses',
            )->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('role_id')->constrained(
                table: 'roles',
            )->restrictOnUpdate()->restrictOnDelete();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
