<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('invoice')->nullable();
            $table->string('order_num')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('terms')->nullable();
            $table->string('due_date')->nullable();
            $table->string('saleman')->nullable();
            $table->longText('subject')->nullable();
            $table->double('total', 10, 2)->nullable();
            $table->double('pending', 10, 2)->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
