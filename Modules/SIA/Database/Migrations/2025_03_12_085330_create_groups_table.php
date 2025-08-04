<?php

   namespace Modules\SIA\Database\Migrations;

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

return new class extends Migration
   {
       public function up(): void
       {
           Schema::create('groups', function (Blueprint $table) {
               $table->id();
               $table->string('name', 100)->unique();
               $table->string('description', 500);
               $table->timestamps();
               $table->softDeletes();
           });
       }

       public function down(): void
       {
           Schema::dropIfExists('groups');
       }
   };