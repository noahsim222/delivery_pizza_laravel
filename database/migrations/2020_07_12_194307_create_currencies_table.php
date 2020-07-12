<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateCurrenciesTable.
 */
class CreateCurrenciesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('currencies', function(Blueprint $table) {
            $table->id();
			$table->string('name');
			$table->string('code')->nullable();
			$table->string('symbol')->nullable();
			$table->string('precision')->nullable();
			$table->string('thousand_separator')->nullable();
			$table->string('decimal_separator')->nullable();

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
		Schema::drop('currencies');
	}
}
