<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email', 160)->unique();
            $table->integer('verify')->default(0);
            $table->integer('role')->default(0)->comment('1 for admin, 3 for agric, 4 of investor');
            $table->string('fullname', 160)->nullable();
            $table->string('company_website', 160)->nullable();
            $table->string('phone_number', 160)->nullable();
            $table->string('contact_person', 160)->nullable();
            $table->string('password')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->unsignedBigInteger("created_by")->nullable();
             $table->unsignedBigInteger("status_id")->default(1);
           
            $table->string('invitation_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            
           // $table->foreignId('status_id')->constrained()->onDelete('cascade');
           // $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
