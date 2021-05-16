<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeStatusToFailedTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER statusfailedchange AFTER UPDATE ON pemesanan
        FOR EACH ROW
            IF NEW.status = "cancelled"
                THEN
                    UPDATE pengiriman k 
                    inner join pemesanan p 
                        ON k.pemesanan_id = p.id
                        SET k.status = "not processed"
                        WHERE p.status = "cancelled";
            END IF');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `statusfailedchange`');
    }
}
