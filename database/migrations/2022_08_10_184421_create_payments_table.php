<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    protected $table = "stocks";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('rr_id')->nullable();
            $table->dateTime('date')->nullable();
            $table->double('amount', 10, 2)->nullable();
            $table->integer('tax_deducted')->default(1);
            $table->string('reference')->nullable();
            $table->string('payment_mothod')->nullable();
   

            $table->text('note')->nullable();
   
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
        Schema::dropIfExists('payments');
    }
}
