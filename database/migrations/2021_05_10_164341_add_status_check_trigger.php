<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusCheckTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER statuschange AFTER UPDATE ON inventori_produk
        FOR EACH ROW
            IF NEW.qty = 0
                THEN
                    UPDATE produk p 
                    inner join inventori_produk i 
                        ON p.id = i.produk_id
                        SET status = 0
                        WHERE i.qty = 0;
            END IF');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `statuschange`');
    }
}
