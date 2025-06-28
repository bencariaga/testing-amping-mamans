<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterServicesAssistAmtDecimal extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->decimal('assist_amt', 15, 2)->change();
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('assist_amt', 11)->change();
        });
    }
}