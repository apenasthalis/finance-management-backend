<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expense', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('category')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->date('created_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expense');
    }
};
