<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('rcv_address'); // Kolom untuk alamat penerima
            $table->decimal('rcv_amount_token', 20, 8); // Kolom untuk jumlah token yang diterima
            $table->string('rcv_currency'); // Kolom untuk mata uang
            $table->decimal('rcv_amount_currency', 20, 8); // Kolom untuk jumlah mata uang yang diterima
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
