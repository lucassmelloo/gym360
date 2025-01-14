<?php

use App\Models\Workout;
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
        Schema::create('workout_divisions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Workout::class)->constrained()->onDelete('cascade');
            $table->string('title');
            $table->tinyInteger('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_divisions');
    }
};
