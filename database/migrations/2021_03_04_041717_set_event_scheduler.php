<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SetEventScheduler extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       DB::unprepared("SET GLOBAL event_scheduler = ON;");
    }

    /**
     * Reverse the migrations.  
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("SET GLOBAL event_scheduler = OFF;");
    }
}
