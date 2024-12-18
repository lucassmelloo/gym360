<?php

use App\Models\Exercise;
use App\Models\Method;
use App\Models\User;
use App\Models\WorkoutDivision;
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
        Schema::create('workout_division_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(WorkoutDivision::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Method::class)->constrained();
            $table->foreignIdFor(Exercise::class)->constrained();
            $table->tinyInteger('series');
            $table->string('repetitions');
            $table->tinyInteger('order')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_division_exercises');
    }
};
