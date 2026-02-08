<?php

use App\Models\Author;
use App\Models\Category;
use App\Models\Language;
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
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->nullable();
            $table->string('title');
            $table->longText('description');
            $table->string('cover');
            $table->string('image')->nullable();
            $table->integer('pages');
            $table->integer('year');
            $table->foreignIdFor(Author::class);
            $table->foreignIdFor(Language::class); // e.g., 'English', 'Russian', 'Armenian'
            $table->foreignIdFor(Category::class); // Matches the 'id' in 'categories'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
