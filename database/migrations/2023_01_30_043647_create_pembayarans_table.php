<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('reservasi_id')->unsigned()->nullable();
            $table->foreign('reservasi_id')->references('id')->on('reservasis')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('total_harga');
            $table->string('uang_bayar');
            $table->string('kode_bayar');
            $table->timestamps();
        });

        DB::unprepared('CREATE TRIGGER `insert_history` AFTER UPDATE ON `pembayarans` FOR EACH ROW
            INSERT INTO history_trans(history_trans.kode_bayar,history_trans.reservasi_id,history_trans.total_harga, history_trans.uang_bayar) 
            VALUES(NEW.kode_bayar, NEW.reservasi_id, NEW.total_harga, NEW.uang_bayar)
        ');

        DB::unprepared('CREATE TRIGGER `update_status_reservasi` AFTER UPDATE ON `pembayarans` FOR EACH ROW
            UPDATE reservasis SET reservasis.status_pay = 1 
            WHERE reservasis.id = NEW.reservasi_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
};
