<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;
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
        Schema::table('users', function(Blueprint $table) {
            $table->bigInteger('created_by_user_id')->nullable(true)->after('password');
            $table->bigInteger('last_update_user_id')->nullable(true)->after('password');
            $table->timestamp('last_login_time')->nullable(true)->after('password');
            $table->boolean('active')->default(true)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
