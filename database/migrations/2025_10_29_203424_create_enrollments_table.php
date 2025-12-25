<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('mid_comission_subject_id')->constrained('mid_comissions_subjects')->onDelete('cascade');
            $table->year('enrollment_year');
            $table->enum('enrollment_status', ['ACTIVO', 'FINALIZADO', 'CANCELADO'])->default('ACTIVO');
            $table->unique(['user_id', 'mid_comission_subject_id'], 'enrollment_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};