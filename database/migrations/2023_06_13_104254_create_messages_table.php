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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('developer_id')->nullable();
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('set null');
            $table->string('name');
            $table->string('slug');
            $table->string('email', 30);
            $table->string('subject', 50);
            $table->dateTime('meeting_date')->nullable();
            $table->text('content');
            $table->boolean('read');
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
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_developer_id_foreign');
            $table->dropColumn('developer_id');
        });
        Schema::dropIfExists('messages');
    }
};
