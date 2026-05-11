<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->comment('User task categories');

            $table->id()->comment('Category identifier');
            $table->foreignIdFor(User::class)->comment('Owner user identifier')->constrained()->cascadeOnDelete();
            $table->string('name')->comment('Category name');
            $table->timestamps();
            $table->softDeletes()->comment('Category soft deletion timestamp');

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
