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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('uid_no');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            $table->date('dob');
            $table->text('image');
            $table->string('adhaar_no')->nullable();
            $table->string('nickname')->nullable();
            $table->string('marital_status');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('guardian_name');
            $table->string('guardian_relation');
            $table->enum('status', ['active', 'inactive', 'pending', 'passout', 'hold'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
