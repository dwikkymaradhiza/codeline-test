<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->unsignedInteger('created_by')->nullable();

            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->decimal('rating', 2, 1);
            $table->integer('ticket_price');
            $table->string('photo');
            $table->date('release_date');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('films');
    }
}
