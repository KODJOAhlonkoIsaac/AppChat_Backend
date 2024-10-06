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
        Schema::create('groupe_members', function (Blueprint $table) {
            $table->id();

            $table->string('email')->nullable();
            $table->string('if_already_register')->default(true);

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('groupe_id')->nullable();
            $table->foreign('groupe_id')->references('id')->on('groupes')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groupe_members');
    }
};
