<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index('name', 'categories_name_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
