<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFXRatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('FXRates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->char('from', 3);
			$table->char('to', 3);
			$table->double('conversion_rate', 15, 8);
			$table->timestamps();
			$table->index('from');
			$table->index('to');
		});
		$this->insertSampleData();
	}

	/**
	 * Sample data for demonstration purposes
	 *
	 * @return void
	 */
	private function insertSampleData()
	{		
	    DB::table('FXRates')->insert(
		array(
		    'from' => 'GBP',
		    'to' => 'USD',
		    'conversion_rate' => 1.16
		)
	    );
	    DB::table('FXRates')->insert(
		array(
		    'from' => 'GBP',
		    'to' => 'EUR',
		    'conversion_rate' => 1.06
		)
	    );
	    DB::table('FXRates')->insert(
		array(
		    'from' => 'USD',
		    'to' => 'GBP',
		    'conversion_rate' => 0.86
		)
	    );
	    DB::table('FXRates')->insert(
		array(
		    'from' => 'USD',
		    'to' => 'EUR',
		    'conversion_rate' => 0.92
		)
	    );
	    DB::table('FXRates')->insert(
		array(
		    'from' => 'EUR',
		    'to' => 'GBP',
		    'conversion_rate' => 0.94
		)
	    );
	    DB::table('FXRates')->insert(
		array(
		    'from' => 'EUR',
		    'to' => 'USD',
		    'conversion_rate' => 1.09
		)
	    );
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('FXRates');
	}

}
