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
        Schema::create('queries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('contact_no');
            // $table->string('branch');
            $table->string('department');
            $table->string('channel');
            $table->string('concern');
            $table->string('urgency');
            $table->string('status')->default('Pending');
            $table->string('resolved_by')->nullable();
            $table->text('issue')->nullable();
            $table->text('action_taken')->nullable();
            $table->text('remarks')->nullable();
            // $table->boolean('is_member');
            $table->dateTime('resolved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queries');
    }
};
