<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationtraitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificationtraits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('traitant_id');
            $table->foreign('traitant_id')->references('id_traitant')->on('traitants')->onDelete('cascade');;
         $table->unsignedBigInteger('parentt_id');
            $table->foreign('parentt_id')->references('id_parentt')->on('parentts')->onDelete('cascade');;
            $table->Date('dateNotificationtrait')->nullable();
            $table->integer('etat')->default(1);
            $table->string('detail')->nullable();
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
        Schema::dropIfExists('notificationtraits');
    }
}
