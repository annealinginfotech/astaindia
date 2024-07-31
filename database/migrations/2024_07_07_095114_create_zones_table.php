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
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->text('zone_name');
            $table->enum('zone_type', ['headquarters', 'state', 'branch', 'unit' ]);
            $table->bigInteger('parent_zone');
            $table->longText('address');
            $table->string('phone_no');
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
        Schema::dropIfExists('zones');
    }
};
