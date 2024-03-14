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
            $table->boolean('gender')->nullable()->default(true);
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('photo', 255)->nullable();
            $table->text('about')->nullable();
            $table->date('join_date')->nullable();
            $table->string('second_email', 255)->nullable();
            $table->string('second_phone', 255)->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable();
           
            $table->integer('status')->default(0);
           
            $table->string('comp_city', 100)->nullable();
            $table->string('zip_code', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->string('consignee', 100)->nullable();
            $table->string('cons_street', 100)->nullable();
            $table->string('cons_box', 100)->nullable();
            $table->string('cons_city', 50)->nullable();
            $table->string('cons_zip_code', 50)->nullable();
            $table->string('cons_country', 50)->nullable();
            $table->string('cons_phone', 50)->nullable();
            $table->string('cons_email', 50)->nullable();
            $table->string('cons_fax', 50)->nullable();
            $table->string('cons_poc', 50)->nullable();
            $table->string('notify_party', 50)->nullable();
            $table->string('notify_street', 100)->nullable();
            $table->string('notify_box', 50)->nullable();
            $table->string('notify_city', 50)->nullable();
            $table->string('notify_state', 50)->nullable();
            $table->string('notify_zip', 50)->nullable();
            $table->string('notify_country', 50)->nullable();
            $table->string('notify_phone', 50)->nullable();
            $table->string('notify_email', 50)->nullable();
            $table->string('notify_fax', 50)->nullable();
            $table->string('notify_poc', 50)->nullable();
            $table->text('loading_instruction')->nullable();
            $table->string('token', 100);
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by')->nullable();

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
