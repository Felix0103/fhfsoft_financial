<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->date('creation_date');
            $table->foreignId('loan_type_id');
            $table->foreignId('sub_account_id');
            $table->foreignId('billing_cycle_id');
            $table->decimal('rate');
            $table->date('start_date');
            $table->decimal('amount');
            $table->integer('fees_quantity');
            $table->integer('doc_entry')->default(1);;

            $table->integer('active')->default(1);
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
        Schema::dropIfExists('loans');
    }
}
