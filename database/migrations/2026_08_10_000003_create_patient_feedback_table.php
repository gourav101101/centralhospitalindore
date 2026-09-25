<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patient_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name')->nullable();
            $table->string('department')->nullable();
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('feedback');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_feedback');
    }
};
