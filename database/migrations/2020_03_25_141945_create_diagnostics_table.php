<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enfant_id');
            $table->foreign('enfant_id')->references('id_enfant')->on('enfants')->onDelete('cascade');
            $table->unsignedBigInteger('carsspecialiste_id');
            $table->foreign('carsspecialiste_id')->references('id_carsspecialiste')->on('carsspecialistes')->onDelete('cascade');
            $table->integer('id_superviseur');
            $table->Date('dateDiagnostic');
            $table->text('niveau');
            $table->text('remarque')->nullable();
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
        Schema::dropIfExists('diagnostics');
    }
}
