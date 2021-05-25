<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelTaskTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('label_task')) {
            Schema::create('label_task', function (Blueprint $table) {
                $table->id();
                $table->foreignId('label_id')->constrained();
                $table->foreignId('task_id')->constrained();
                $table->unique(['label_id', 'task_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_task');
    }
}
