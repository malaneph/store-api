<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->foreignIdFor(Category::class);
            $table->boolean('in_stock');
            $table->decimal('rating');
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->index('name', 'products_name_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
