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
            $table->integer('customer_id');
            $table->integer('invoice_id');
            $table->string('year')->nullable();
            $table->string('container_number')->nullable();
            $table->string('title_received_date')->nullable();
            $table->string('title_number')->nullable();
            $table->string('title_state')->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('pickup_date')->nullable();
            $table->string('deliver_date')->nullable();
            $table->text('note')->nullable();
            $table->string('color')->nullable();
            $table->string('model')->nullable();
            $table->string('vin')->default('0');
            $table->string('weight')->nullable();
            $table->text('cbm')->nullable();
            $table->string('value')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('storage_amount')->nullable();
            $table->string('check_number')->nullable();
            $table->string('add_charges')->nullable();
            $table->string('lot_number')->nullable();
            $table->string('htnumber')->nullable();
            $table->text('c_remark')->nullable();
            $table->string('make')->nullable();
            $table->string('towed_from')->nullable();
            $table->string('tow_amount')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->enum('status', ['pending', 'on_the_way', 'on_hand_with_title', 'on_hand_no_title', 'shipped'])->default('on_the_way');
            $table->enum('vehicle_type', ['half-cut', 'complete'])->default('complete');
            $table->date('payment_date')->nullable();
            $table->string('shipas')->nullable();
            $table->integer('port_of_loading_id')->nullable();
            $table->string('buyer_number')->nullable();
            $table->text('photos_link')->nullable();
            $table->integer('storage_cost')->default(0);
            $table->integer('vehicle_price')->nullable();
            $table->string('auction_fee')->nullable();
            $table->integer('tow_amounts')->nullable();
            $table->integer('dismantal_cost')->nullable();
            $table->integer('ship_cost')->nullable();
            $table->integer('dubai_custom_cost')->nullable();
            $table->integer('dubai_storage_cost')->nullable();
            $table->integer('dubai_demurage')->nullable();
            $table->integer('other_cost')->nullable();
            $table->integer('sales_cost')->nullable();
            $table->integer('profit')->nullable();
            $table->string('percent_profit')->nullable();
            $table->string('auction')->nullable();
            $table->string('auction_city')->nullable();
            $table->string('title')->nullable();
            $table->string('pickup_due_date')->nullable();
            $table->string('title_status')->nullable();
            $table->tinyInteger('is_key')->default(0);
            $table->text('customer_note')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('deleted_by')->nullable();

            $table->primary('id');
            $table->unique('vin');
            $table->index('created_by');
            $table->index('updated_by');
            $table->index('deleted_by');
            
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('set null');

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
