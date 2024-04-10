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
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('bill_no');
            $table->text('branch');
            $table->string('name');
            $table->dateTime('billing_date');
            $table->longText('description');
            $table->string('cheque_no')->nullable();
            $table->date('cheque_issue_date')->nullable();
            $table->text('bank_of_cheque')->nullable();
            $table->double('total_amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
