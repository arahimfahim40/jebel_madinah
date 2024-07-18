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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();

            $table->integer('year')->nullable();
            $table->string('make', 64)->nullable();
            $table->string('model', 64)->nullable();
            $table->string('color', 64)->nullable();
            $table->string('vin', 32)->nullable();
            $table->unsignedBigInteger('lot_number');
            $table->string('container_number', 16)->nullable();
            $table->string('buyer_number', 64)->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['on_the_way', 'inventory', 'sold'])->default('on_the_way');
            $table->enum('auction_name', ['Copart', 'IAAI'])->nullable()->default('Copart');

            // Vehicle Charges
            $table->decimal('vehicle_price', 10, 0)->nullable();
            $table->decimal('towing_cost', 10, 0)->nullable();
            $table->decimal('clearance_cost', 10, 0)->nullable();
            $table->decimal('ship_cost', 10, 0)->nullable();
            $table->decimal('storage_cost', 10, 0)->nullable();
            $table->decimal('custom_cost', 10, 0)->nullable();
            $table->decimal('tds_cost', 10, 0)->nullable();
            $table->decimal('other_cost', 10, 0)->nullable();
            $table->text('invoice_description')->nullable();
            // Vehicle Costs
            $table->decimal('sold_price', 10, 0)->nullable();

            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->unique('vin')->index();
            $table->index('lot_number');
            $table->index('container_number');
            $table->index('invoice_id');
            $table->index('created_by');
            $table->index('updated_by');
            $table->index('deleted_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');

            $table->foreign('owner_id')->references('id')->on('owners')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
