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
        Schema::create('user_contact_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->longText('address');
            $table->string('primary_contact');
            $table->string('secondary_contact')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('emergency_contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_contact_details');
    }
};
