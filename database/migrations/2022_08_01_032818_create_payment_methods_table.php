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
            figure_path    varchar(100)         null,
            qrcode_path    varchar(100)         null,
            qrcode_link    varchar(300)         null,
            ac_number_title    varchar(100)     null,
            ac_number      varchar(100)         null,
            cheque_heading      varchar(100)    null,
            type      	   enum (qrcode, cheque, transfer, online)    not null,
            address        varchar(100)         null,
            payment_approval_remark        varchar(255)         null,
            remark         varchar(200)         null,
            display_order  int                  null,
            active         tinyint(1) default 1 not null,
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
        Schema::dropIfExists('payment_methods');
    }
};
