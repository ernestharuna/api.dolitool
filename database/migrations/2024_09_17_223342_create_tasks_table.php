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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id')->cascadeOnDelete();
            $table->foreignId('task_group_id')->constrained('task_groups', 'id')->cascadeOnDelete();
            $table->string('title');
            $table->text('description');

            $table->string('due_date');

            $table->enum('status', [
                'complete',
                'pending',
                'not_done'
            ])->default('not_done');

            $table->enum('priority', [
                'high',
                'medium',
                'low'
            ])->default('medium');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
