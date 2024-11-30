<?php

use App\Models\User;
use App\Models\WorkoutType;
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
        Schema::create('workout_models', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(WorkoutType::class)->constrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
