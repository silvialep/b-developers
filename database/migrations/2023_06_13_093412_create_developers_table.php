<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('last_name', 50);
            $table->string('address', 50);
            $table->string('cv', 255)->nullable();
            $table->string('picture', 255)->nullable();
            $table->string('phone', 10)->nullable();
            $table->text('services')->nullable();
            $table->string('role', 50)->nullable();
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
        Schema::table('developers', function (Blueprint $table) {
            $table->dropForeign('developers_user_id_foreign');
            $table->dropColumn('user_id');
        });
        
        Schema::dropIfExists('developers');
        
    }
};
