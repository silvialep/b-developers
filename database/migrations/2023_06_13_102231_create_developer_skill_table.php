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
        Schema::create('developer_skill', function (Blueprint $table) {
            
            $table->unsignedBigInteger('developer_id');
            $table->unsignedBigInteger('skill_id');

            //definisco le foreign key della tabella ponte
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('developer_skill');
    }
};
