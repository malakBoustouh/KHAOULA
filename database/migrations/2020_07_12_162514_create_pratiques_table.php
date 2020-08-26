<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePratiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pratiques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enfant_id');
            $table->foreign('enfant_id')->references('id_enfant')->on('enfants')->onDelete('cascade');
            $table->unsignedBigInteger('exercice_id');
            $table->foreign('exercice_id')->references('id_exercice')->on('exercices')->onDelete('cascade');
            $table->Date('datePratique');
            $table->string('niveau');
            $table->integer('score');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pratiques');
    }
}
