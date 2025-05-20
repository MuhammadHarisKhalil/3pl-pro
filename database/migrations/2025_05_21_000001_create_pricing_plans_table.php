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
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('duration')->default('Monthly'); // Monthly, Quarterly, Yearly
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });

        Schema::create('pricing_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pricing_plan_id')->constrained()->onDelete('cascade');
            $table->string('feature_text');
            $table->boolean('is_included')->default(true);
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_features');
        Schema::dropIfExists('pricing_plans');
    }
};