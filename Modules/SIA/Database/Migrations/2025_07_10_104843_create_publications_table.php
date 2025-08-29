<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreatePublicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();

            // Autor: aprendiz que crea la publicación
            $table->foreignId('author_id')
                ->constrained('people')
                ->cascadeOnDelete();

            // Revisor: admin o responsable de validar
            $table->foreignId('reviewer_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();

            // Título y archivo PDF
            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable();
            $table->string('pdf_path');

            // Fechas de publicación y revisión
            $table->date('publication_date');
            $table->date('review_date')->nullable();

            // Estado de la publicación
            $table->enum('status', ['Pendiente', 'Publicada', 'Rechazada'])
                ->default('Pendiente');

            // Comentarios del revisor (opcional)
            $table->text('reviewer_comments')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Índices para búsquedas más eficientes
            $table->index(['status', 'publication_date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
}
