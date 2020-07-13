<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateItemPricesTable.
 */
class CreateItemPricesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('item_prices', function(Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('currency_id');
			$table->float('price')->default(0);
			$table->unsignedBigInteger('item_id');

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
		Schema::drop('item_prices');
	}
}
