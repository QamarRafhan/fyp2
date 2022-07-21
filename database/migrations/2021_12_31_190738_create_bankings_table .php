<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankings', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('acc_name')->nullable();
            $table->string('acc_holder_name')->nullable();
            $table->string('acc_code')->nullable();
            $table->string('currency')->nullable();
            $table->string('acc_num')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('routing_num')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
           
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bankings');
    }
}
