<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairingRequetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairing_requets', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('video_url')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('mechanic_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('mechanic_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairing_requets');
    }
}
