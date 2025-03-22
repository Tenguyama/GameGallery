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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256);
            $table->string('developer', 512);
            $table->string('genre', 512); // for example, create many genres with a "," separator (strategy, shooter, horror...)
            $table->date('release_date');
            $table->string('platform', 256);
            $table->decimal('price', 8, 2);
            $table->string('img_url', 2083)->nullable(); //2083 - max url length
            $table->timestamps(); // for example, we will see the value of "updated_at" change for the updated entity
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
