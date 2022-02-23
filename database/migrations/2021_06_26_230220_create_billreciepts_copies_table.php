<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillrecieptsCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billreciepts_copies', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no');
            $table->string('user');
            $table->string('vehicle');
            $table->string('d_name_1')->default('Diesel-1');
            $table->double('d_quantity_1')->default('0');
            $table->double('d_unit_price_1')->default('0');
            $table->double('d_commision_1')->default('0');
            $table->double('d_subtotal_1')->default('0');
            $table->double('d_depriciate_1')->default('0');
            
            $table->string('d_name_2')->default('Diesel-2');
            $table->double('d_quantity_2')->default('0');
            $table->double('d_unit_price_2')->default('0');
            $table->double('d_commision_2')->default('0');
            $table->double('d_subtotal_2')->default('0');
            $table->double('d_depriciate_2')->default('0');
            
            $table->string('p_name')->default('Petrol');            
            $table->double('p_quantity')->default('0');
            $table->double('p_unit_price')->default('0');
            $table->double('p_commision')->default('0');
            $table->double('p_subtotal')->default('0');
            $table->double('p_depriciate')->default('0');
            $table->string('o_name')->default('Octane');
            $table->double('o_quantity')->default('0');
            $table->double('o_unit_price')->default('0');
            $table->double('o_commision')->default('0');
            $table->double('o_subtotal')->default('0');
            $table->double('o_depriciate')->default('0');
            $table->string('l_name')->default('Lube');
            $table->double('l_quantity')->default('0');
            $table->double('l_unit_price')->default('0');
            $table->double('l_subtotal')->default('0');
            $table->double('grandtotal')->default('0');
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
        Schema::dropIfExists('billreciepts_copies');
    }
}
