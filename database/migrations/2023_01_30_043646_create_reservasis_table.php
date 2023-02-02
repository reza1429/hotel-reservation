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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('kamar_id')->unsigned();
            $table->foreign('kamar_id')->references('id')->on('tbl_kamars')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->BigInteger('pengunjung_id')->unsigned()->nullable();
            $table->foreign('pengunjung_id')->references('id')->on('pengunjungs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('status_pay');
            $table->integer('lama_sewa');
            $table->timestamps();
        });

        DB::unprepared('CREATE TRIGGER `update_status_kamar` AFTER INSERT ON `reservasis` FOR EACH ROW
            UPDATE tbl_kamars SET tbl_kamars.status = 1 
            WHERE  tbl_kamars.id = NEW.kamar_id
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservasis');
    }
};
