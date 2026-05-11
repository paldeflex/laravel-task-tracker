<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->comment('User tasks');

            $table->id()->comment('Task identifier');
            $table->foreignIdFor(User::class)->comment('Owner user identifier')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Category::class)->comment('Task category identifier')->nullable()->constrained()->nullOnDelete();
            $table->string('title')->comment('Task title');
            $table->string('description')->nullable()->comment('Task description');
            $table->boolean('is_recurring')->default(false)->comment('Whether the task is recurring');
            $table->dateTime('task_date')->nullable()->comment('Scheduled task date and time');
            $table->dateTime('completed_at')->nullable()->comment('Task completion timestamp');
            $table->timestamps();
            $table->softDeletes()->comment('Task soft deletion timestamp');

            $table->index('user_id');
            $table->index('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
