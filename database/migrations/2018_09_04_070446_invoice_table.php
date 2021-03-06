<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('id_invoice')->index();;
            $table->string('ref_id')->nullable();
            $table->dateTime('invoice_date');
            $table->dateTime('rent_date');
            $table->dateTime('deadline_date');
            $table->string('cust_name', 255);
            $table->string('cust_phone', 14);
            $table->text('address');
            $table->double('total_price', 20, 2);
            $table->double('discount', 20, 2);
            $table->integer('status')->default(0);
            $table->double('dp', 20, 2);
            $table->string('admin', 255);
            $table->text('description')->nullable();
            $table->string('type', 15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice', function (Blueprint $table) {
            //
        });
    }
}
