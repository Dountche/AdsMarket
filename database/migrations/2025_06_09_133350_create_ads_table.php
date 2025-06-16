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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->decimal("price", 10, 2);
            $table->enum('status', ['brouillon', 'pending', 'publie', 'archive'])->default('pending');
            $table->string('city');
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on('users')->onDelete("cascade");
            $table->unsignedBigInteger("id_cat")->nullable();
            $table->foreign("id_cat")->references("id")->on("categories")->onDelete("set null");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
