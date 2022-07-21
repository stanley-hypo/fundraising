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
        //roles initialize
        Schema::table('roles', function($table) {
            $table->boolean('cancreate')->default(true)->after('guard_name');
            $table->boolean('active')->default(true)->after('cancreate');
        });

        DB::table('roles')->insert(
            array(
                'name' => 'Superadmin',
                'guard_name' => 'adminapi',
                'cancreate'=>false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        );
        DB::table('roles')->insert(
            array(
                'name' => 'Administrator',
                'guard_name' => 'adminapi',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ),
        );

        Schema::table('permissions', function($table) {
            $table->string('description', 100)->after('guard_name');
            $table->tinyInteger('active')->default(1)->after('description');
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
