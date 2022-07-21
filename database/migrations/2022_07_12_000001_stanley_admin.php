<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
            $table->boolean("isadmin")->after('remember_token')->default(false);
        });

        DB::table('users')->insert(
            array(
                'email' => 'admin@hypoidea.com',
                'name'=>"Super Admin",
                "password"=>Hash::make("abc12345"),
                'isadmin'=>true,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            )
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('isadmin');
        });
    }
};
