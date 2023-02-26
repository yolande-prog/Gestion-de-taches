<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('contract_name');
            $table->string('reconduction_name');
            $table->string('function');
            $table->string('city');
            $table->integer('duration');
            $table->date('start_contract_date');
            $table->date('end_contract_date');
            $table->string('advance_notice_reconduction');
            $table->date('alarm1_date');
            $table->date('alarm2_date');
            $table->date('alarm3_date');
            $table->longText('observation')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_accounts');
    }
}
