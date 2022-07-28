<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        DB::statement('create table subscription
        (
            id             bigint unsigned auto_increment
                primary key,
            name           varchar(50)          not null,
            title          varchar(10)          not null,
            type           varchar(255)         not null,
            amount         float                not null,
            contact_number varchar(20)          not null,
            email          varchar(50)          not null,
            address        varchar(255)         null,
            area           varchar(50)          null,
            district       varchar(50)          null,
            payment_method varchar(255)         not null,
            receipt        tinyint(1) default 0 not null,
            interested     tinyint(1) default 0 null,
            created_at     timestamp            null,
            updated_at     timestamp            null
        )
            collate = utf8mb4_unicode_ci;
        
        ');    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscription');
    }
};
