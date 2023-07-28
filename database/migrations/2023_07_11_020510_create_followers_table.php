<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

     //*importante: 
     /*
      la tabla followers funciona como una tabla pivote entreo dos tablas user
      obviamente no hay dos tablas users, pero en la tabal followers almacenaremos
      como si hubiera dos tablas users, almacenamos un userId y un followerId ambos
      pertenecientes a un usuario en la tabla user
     */
    public function up(): void
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
