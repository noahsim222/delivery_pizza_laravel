<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOrdersTable.
 */
class CreateOrdersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('currency_id');
			$table->unsignedBigInteger('delivery_info_id');
			$table->bigInteger('user_id')->nullable();
			$table->string('payment_method')->default('CASH');
			$table->bigInteger('total_cost');
			$table->integer('status')->default(0);

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orders');
	}
}
