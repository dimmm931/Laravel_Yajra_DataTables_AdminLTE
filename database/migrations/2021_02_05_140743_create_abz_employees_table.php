<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbzEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
	  if (!Schema::hasTable('abz_employees')) { //my fix for migration
        Schema::create('abz_employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment = 'employee Last/First name';
            $table->string('email')->unique();
            $table->string('username');
            $table->string('phone');
            $table->string('dob');
		    $table->string('image')->comment = 'empolyee photo';
			
			//Create 'rank_id' level. Foreign key for table {abz_ranks}	
			$table->bigInteger('rank_id')->unsigned()->comment = 'Rank Id from table (abz_ranks) (ForeignKey)'; 
            $table->foreign('rank_id')->references('id')->on('abz_ranks')->onUpdate('cascade')->onDelete('cascade');  //Id from table {abz_ranks}
	        //End Create Foreign key for table {shop_orders_main}
			
			//Create employees's superior. Foreign key for this same table itself {abz_employees}m column ID	
			$table->bigInteger('superior_id')->unsigned()->comment = 'Superior Id from this same table itself (abz_employees) (ForeignKey)'; 
            $table->foreign('superior_id')->references('id')->on('abz_employees')->onUpdate('cascade')->onDelete('cascade');  //Id from this same table itself {abz_employees}
	        //End Create Foreign key for table {shop_orders_main}
			
				
			$table->decimal('salary', 6, 2)->comment = 'Salary'; // DECIMAL equivalent with a precision and scale //this means that your column is set up to store 6 places (scale), with 2 to the right of the decimal (precision). A sample would be 1234.56.
            $table->date('hired_at')->comment = 'date when was hired'; //DATE equivalent to the table
			
            $table->timestamps();
        });
	  }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('abz_employees');
    }
}
