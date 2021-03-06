<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateVoucherEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("DROP EVENT IF EXISTS reset_vouchers");
        $now = \Carbon\Carbon::now()->subDays(2)->toDateTimeString();
        DB::unprepared("CREATE EVENT reset_vouchers ON SCHEDULE EVERY 1 MINUTE STARTS '". $now ."' ON COMPLETION NOT PRESERVE DO UPDATE vouchers SET customer_id = NULL, locked_at = NULL, expired_at = NULL WHERE expired_at < CONVERT_TZ(NOW(), @@session.time_zone, '+07:00') AND redeemed = 0");
    }

    /**
     * Reverse the migrations.  
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP EVENT IF EXISTS reset_vouchers");
    }
}
