<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('wf_entity_borrow_requests')) {
            Schema::create('wf_entity_borrow_requests', function (Blueprint $table) {
                $table->string('id', 10)->primary();
                $table->string('case_id')->nullable();
                $table->string('case_number')->nullable();
                $table->string('item_name');
                $table->string('item_id')->nullable();
                $table->unsignedInteger('quantity')->default(1);
                $table->unsignedBigInteger('requester_id')->nullable();
                $table->unsignedBigInteger('delivery_id')->nullable();
                $table->string('delivered_at')->nullable();
                $table->unsignedBigInteger('delivered_at_alt')->nullable();
                $table->string('expected_return_date')->nullable();
                $table->unsignedBigInteger('expected_return_date_alt')->nullable();
                $table->string('actual_return_date')->nullable();
                $table->unsignedBigInteger('actual_return_date_alt')->nullable();
                $table->string('status')->default('requested');
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->json('contributers')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('wf_entity_products')) {
            Schema::create('wf_entity_products', function (Blueprint $table) {
                $table->string('id', 10)->primary();
                $table->string('name');
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->json('contributers')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('wf_entity_consumable_parts')) {
            Schema::create('wf_entity_consumable_parts', function (Blueprint $table) {
                $table->string('id', 10)->primary();
                $table->string('case_id')->nullable();
                $table->string('case_number')->nullable();
                $table->string('product_id')->nullable();
                $table->string('product_name')->nullable();
                $table->unsignedInteger('requested_quantity')->default(0);
                $table->unsignedInteger('delivered_quantity')->nullable();
                $table->unsignedInteger('required_quantity_to_purchase')->nullable();
                $table->unsignedInteger('purchased_quantity')->nullable();
                $table->string('consumable_part_status')->nullable();
                $table->string('consumable_part_state')->nullable();
                $table->unsignedInteger('returned_quantity')->nullable();
                $table->decimal('amount', 18, 2)->nullable();
                $table->string('supply_source')->nullable();
                $table->string('invoice_number')->nullable();
                $table->string('invoice_date')->nullable();
                $table->unsignedBigInteger('invoice_date_alt')->nullable();
                $table->boolean('external_buying_is_done')->default(false);
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->json('contributers')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('wf_entity_consumable_part_additional_info')) {
            Schema::create('wf_entity_consumable_part_additional_info', function (Blueprint $table) {
                $table->string('id', 10)->primary();
                $table->string('case_id')->nullable();
                $table->string('case_number')->nullable();
                $table->string('consumable_parts_id', 10)->nullable();
                $table->string('order_date')->nullable();
                $table->string('receipt_date')->nullable();
                $table->decimal('unit_price', 18, 2)->nullable();
                $table->string('currency')->nullable();
                $table->unsignedBigInteger('order_date_alt')->nullable();
                $table->unsignedBigInteger('receipt_date_alt')->nullable();
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->json('contributers')->nullable();
                $table->timestamps();
                $table->softDeletes();
                $table->index('consumable_parts_id', 'wf_consumable_parts_id_idx');
            });
        }
    }

    public function down(): void
    {
        // These compatibility tables may have existed before this migration ran.
        // Keep rollback non-destructive so it cannot remove customer data.
    }
};
