<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_deals', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title', 150);
            $table->string('description', 500);
            $table->integer('investor_id');
            $table->integer('deal_value');
            $table->integer('pipeline_id')->default(1);
            $table->date('expected_closing_date');
            $table->integer('status')->default(0)->comment("0 for open 1 for close 2 for won");
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
        Schema::dropIfExists('manage_deals');
    }
}
