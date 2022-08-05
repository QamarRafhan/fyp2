<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->string('locale', 15)->default('en');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('latitude')->nullable();
                $table->string('longitude')->nullable();
                $table->string('status')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('reset_password_token')->nullable();
                $table->timestamp('reset_password_token_expires')->nullable();
                $table->boolean('guest')->default(0);
                $table->string('role')->nullable();
                $table->boolean('is_active')->default(true);
                $table->boolean('allow_notifications')->default(true);
                $table->bigInteger('category_id')->nullable();
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}