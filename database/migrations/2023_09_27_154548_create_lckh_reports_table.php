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
        Schema::create('lckh_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table: 'users', indexName: 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->text('upload_document');
            $table->date('monthly_report');
            $table->date('upload_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lckh_reports');
    }
};
