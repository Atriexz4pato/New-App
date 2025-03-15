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
        Schema::dropIfExists('assessments');

        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_assessor_id')->constrained('student_assessor')->onDelete('cascade');
            $table->date('assessment_date')->nullable();
            $table->integer('score')->nullable();
            $table->text('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
