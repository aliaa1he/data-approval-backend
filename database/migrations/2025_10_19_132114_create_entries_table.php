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
         Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->decimal('numeric_value', 10, 2);
            $table->date('date');
            $table->text('notes')->nullable();
            $table->string('status')->default('Pending');
            $table->decimal('calculated_field', 10, 2)->nullable();
            $table->string('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
