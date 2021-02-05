<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbzRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		if (!Schema::hasTable('abz_ranks')) { //my fix for migration
            Schema::create('abz_ranks', function (Blueprint $table) {
                $table->bigIncrements('id');
				$table->string('rank_name')->comment = 'employee rank';
				$table->string('rank_descr')->comment = 'employee rank description';
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
        Schema::dropIfExists('abz_ranks');
    }
}
