<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiaryBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diary_books', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->foreignId('sub_account_id');
            $table->foreignId('client_id');
            $table->decimal('amount');
            $table->date('transaction_date');
            $table->integer('active');
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
        Schema::dropIfExists('diary_books');
    }
}
