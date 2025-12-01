<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('person_plan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('person')->onDelete('cascade');
            $table->foreignId('plan_id')->constrained('plan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('person_plan');
    }
};
