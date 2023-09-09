<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgricBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agric_businesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('organizationName');
            $table->string('dealName');
            $table->string('dealPromoters');
            $table->text('dealDescription');
            $table->string('hasBusinessPlan');
            $table->string('focalStates');
            $table->string('ticketSize');
            $table->text('raiseAmount');
            $table->text('purpose');
            $table->json('preferredValueChain')->comment('1 crop, 2 livestock 3 aquaculture 4 agribusiness 5 other');
            $table->text('otherValueChains')->nullable();
            $table->string('pitchFile')->nullable();
            $table->timestamps();

           // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agric_businesses');
    }
}
