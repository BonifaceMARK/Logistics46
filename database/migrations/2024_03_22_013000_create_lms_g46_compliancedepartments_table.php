<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLmsG46CompliancedepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_g46_Compliancedepartments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('department_id')->unique();
            $table->string('name', 100);
            $table->string('contact_person', 100);
            $table->string('contact_email', 100);
            $table->string('contact_phone', 20);
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
        Schema::dropIfExists('lms_g46_Compliancedepartments');
    }
}
