<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLmsG50CarriersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_g50_carriers', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('company_name');
            $table->string('company_address');
            $table->string('contact_name');
            $table->string('email');
            $table->string('phone');
            $table->string('certificate_of_business_registration_image')->nullable();
            $table->string('certificate_of_dti_image')->nullable();
            $table->string('business_license_image')->nullable();
            $table->string('certificate_of_bir_image')->nullable();
            $table->string('certificate_of_insurance_image')->nullable();
            $table->text('notes')->nullable(); // Added notes field
            $table->string('status')->nullable(); // Added status field
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
        Schema::dropIfExists('lms_g50_carriers');
    }
}

