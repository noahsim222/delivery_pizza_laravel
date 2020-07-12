<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateDeliveryInfosTable.
 */
class CreateDeliveryInfoTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delivery_info', function(Blueprint $table) {
            $table->id();
			$table->bigInteger('delivery_cost')->default(0);
			$table->text('address');
			$table->string('customer_phone')->nullable();
			$table->string('customer_name')->nullable();
			$table->text('note')->nullable();

			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();

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
		Schema::drop('delivery_info');
	}
}
