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
        Schema::create('student_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('student_contact');
            $table->string('student_contact2')->nullable();
            $table->string('student_whatsapp')->nullable();
            $table->string('student_email')->nullable();
            $table->string('guardian_contact');
            $table->string('guardian_whatsapp')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_contacts');
    }
};
