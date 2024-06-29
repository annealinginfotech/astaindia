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
        Schema::create('main_courses', function (Blueprint $table) {
            $table->id();
            $table->text('course_code');
            $table->bigInteger('base_course_id');
            $table->text('name');
            $table->string('min_qualification');
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
        Schema::dropIfExists('main_courses');
    }
};
