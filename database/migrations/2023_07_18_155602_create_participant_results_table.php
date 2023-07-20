<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('participant_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('judge_id')->constrained('users', 'id');
            $table->foreignId('participant_id')->constrained('users', 'id');
            $table->unique(['judge_id', 'participant_id']);
            $table->float('result');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('participant_results');
    }
};
