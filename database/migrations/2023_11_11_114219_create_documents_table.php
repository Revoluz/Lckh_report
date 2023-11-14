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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('filename');
            $table->text('description')->nullable();
            $table->foreignId('user_id')->constrained(table: 'users')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('document_type_id')->constrained(table: 'document_types')->restrictOnUpdate()->restrictOnDelete();
            $table->date('document_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
