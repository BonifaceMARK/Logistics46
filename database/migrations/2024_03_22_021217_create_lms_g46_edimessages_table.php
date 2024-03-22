<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLmsG46EdimessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_g46_edimessages', function (Blueprint $table) {
            $table->id();
            $table->enum('message_type', ['ORDERS', 'INVOICES', 'SHIPMENT_NOTIFICATIONS'])->nullable();
            $table->text('message_body');
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
        Schema::dropIfExists('lms_g46_edimessages');
    }
}
