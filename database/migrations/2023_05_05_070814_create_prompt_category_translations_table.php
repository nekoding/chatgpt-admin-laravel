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
        Schema::create('prompt_category_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('prompt_cat_id')->constrained('prompt_categories');
            $table->string('lang_code')->index();
            $table->string('text')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prompt_category_translations');
    }
};
