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
        Schema::create('downloads_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobile_user_id')->constrained('mobile_user')
            ->onDelete('cascade') ;
            $table->foreignId('exam_id')->constrained('exams')
            ->onDelete('cascade') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('downloads_exams');
    }
};
