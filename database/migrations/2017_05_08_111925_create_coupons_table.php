<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
			$table->enum('status', ['enabled', 'disabled']);
			$table->string('title');
			$table->text('description');
			$table->text('small_print');
			$table->string('barcode_type');
			$table->string('barcode_value');
			$table->date('barcode_begins');
			$table->date('barcode_ends');
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
        Schema::dropIfExists('coupons');
    }
}
