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
        Schema::create('fees_structures', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('main_course_id');
            $table->enum('fees_type', ['admission', 'monthly', 'exam']);
            $table->double('amount');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees_structures');
    }
};
