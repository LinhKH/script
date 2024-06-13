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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_title');
            $table->string('page_slug');
            $table->longText('description'); //LONGTEXT equivalent to the table
            $table->tinyInteger('status')->default('1'); //Declare a default value for a column
            $table->integer('show_in_header')->nullable(); //Declare a default value for a column
            $table->integer('show_in_footer')->nullable(); //Declare a default value for a column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
