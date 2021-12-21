<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
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
            $table->foreignId('chat_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->text('message')->nullable();
            $table->string('file_patch')->nullable();
            $table->string('file_name')->nullable();
            $table->dateTime('sent_at');
            $table->dateTime('seen_at')->nullable();
            $table->enum('type', ['text', 'image', 'file'])->default('text')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('messages');
    }
}
