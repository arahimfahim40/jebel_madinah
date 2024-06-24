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
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('invoice_id')->nullable();
            $table->unsignedBigInteger('point_of_loading_id')->nullable();

            $table->integer('year')->nullable();
            $table->string('make', 64)->nullable();
            $table->string('model', 64)->nullable();
            $table->string('color', 64)->nullable();
            $table->string('vin', 32)->nullable();
            $table->unsignedBigInteger('lot_number');
            $table->string('container_number', 16)->nullable();
            $table->string('title_status')->nullable();
            
            $table->string('title_number', 128)->nullable();
            $table->string('title_received_date')->nullable();
            $table->string('auction', 128)->nullable();
            $table->string('auction_city', 128)->nullable();
            
            $table->date('purchase_date')->nullable();
            $table->date('pickup_date')->nullable();
            $table->date('deliver_date')->nullable();
            $table->date('payment_date')->nullable();

            $table->string('hat_number', 128)->nullable();
            $table->string('buyer_number', 64)->nullable();
            $table->string('licence_number', 64)->nullable();
            $table->decimal('weight', 10, 0)->nullable();
            $table->text('cbm')->nullable();
            
            $table->text('photos_link')->nullable();
            $table->text('auction_invoice_link')->nullable();
            $table->text('customer_remark')->nullable();
            $table->text('note')->nullable();
            
            $table->enum('status', ['pending', 'on_the_way', 'on_hand_with_title', 'on_hand_no_title', 'shipped'])->default('on_the_way');
            $table->enum('ship_as', ['half-cut', 'complete'])->nullable()->default('complete');
            $table->enum('is_key', ['Yes', 'No'])->nullable()->default('No');

            // Vehicle Charges
            $table->decimal('demurage_charge', 10, 0)->nullable();
            $table->decimal('shiping_charge', 10, 0)->nullable();
            $table->decimal('dismantal_charge', 10, 0)->nullable();
            $table->decimal('auction_fee_charge', 10, 0)->nullable();
            $table->decimal('vehicle_price', 10, 0)->nullable();
            $table->decimal('towing_charge', 10, 0)->nullable();
            $table->decimal('clearance_charge', 10, 0)->nullable();
            $table->decimal('ship_charge', 10, 0)->nullable();
            $table->decimal('storage_charge', 10, 0)->nullable();
            $table->decimal('custom_charge', 10, 0)->nullable();
            $table->decimal('tds_charge', 10, 0)->nullable();
            $table->decimal('other_charge', 10, 0)->nullable();
            $table->text('invoice_description')->nullable();
            // Vehicle Costs
            $table->decimal('towing_cost', 10, 0)->nullable();
            $table->decimal('clearance_cost', 10, 0)->nullable();
            $table->decimal('ship_cost', 10, 0)->nullable();
            $table->decimal('storage_cost', 10, 0)->nullable();
            $table->decimal('custom_cost', 10, 0)->nullable();
            $table->decimal('tds_cost', 10, 0)->nullable();
            $table->decimal('other_cost', 10, 0)->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->unique('vin')->index();
            $table->index('lot_number');
            $table->index('container_number');
            $table->index('invoice_id');
            $table->index('point_of_loading_id');
            $table->index('created_by');
            $table->index('updated_by');
            $table->index('deleted_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('point_of_loading_id')->references('id')->on('locations')->onDelete('cascade');

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