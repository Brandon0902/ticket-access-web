<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->boolean('active')->default(true);
            $table->string('qr_code_url');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket');
    }
};
