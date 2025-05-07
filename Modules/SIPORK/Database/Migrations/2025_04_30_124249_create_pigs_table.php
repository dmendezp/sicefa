<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pigs', function (Blueprint $table) {
            $table->id('id_pig');
            $table->date('birth_date')->nullable(false);
            $table->decimal('initial_weight', 6, 2)->nullable(false);
            $table->char('gender', 1)->nullable(false);
            $table->enum('breed', ['Pietrain', 'Duroc', 'Landrace', 'Hampshire', 'Large-White'])->nullable(false);
            $table->string('status', 20)->nullable(false);
            $table->date('weaning_date')->nullable();
            $table->date('sale_date')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->string('gender_check', 6)->nullable(false)->default('Macho')->check("gender_check IN ('Macho', 'Hembra')");
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pigs');
    }
}
