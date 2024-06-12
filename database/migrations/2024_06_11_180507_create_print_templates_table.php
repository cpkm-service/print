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
        Schema::create('print_templates', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable()->comment('類型');
            $table->string('code')->comment('代碼');
            $table->string('name')->comment('名稱');
            $table->binary('content')->nullable()->comment('內容');
            $table->timestamps();
            $table->comment('列印模板');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('print_templates');
    }
};
