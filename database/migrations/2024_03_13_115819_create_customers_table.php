<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('address', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('email', 255)->nullable();
            // $table->string('password', 255);
            $table->string('photo', 255)->nullable();
            $table->text('about')->nullable();
            $table->date('join_date')->nullable();
            $table->string('second_email', 255)->nullable();
            $table->string('second_phone', 255)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
