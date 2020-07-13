<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateTypeTranslationsTable.
 */
class CreateTypeTranslationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('type_translations', function(Blueprint $table) {
            $table->id();
			$table->string('name')->nullable();
            $table->unsignedBigInteger('source_id');
            $table->foreign('source_id')->references('id')->on('types');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')->references('id')->on('languages');

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
		Schema::drop('type_translations');
	}
}
