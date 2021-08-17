<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('identification_type_id')->nullable()->onDelete('set null');
            $table->string('identification');
            $table->double('credit_limit',8,2);
            $table->foreignId('partner_id')->nullable()->onDelete('set null');;
            $table->integer('active')->default(1);
            $table->foreignId('sub_account_id')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
