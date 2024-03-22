<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLmsG46CompliancerequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_g46_compliancerequirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('requirement_id')->unique();
            $table->unsignedInteger('regulation_id');
            $table->text('requirement_text');
            $table->date('deadline');
            $table->string('status', 50);
            $table->unsignedInteger('responsible_department');
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('regulation_id')->references('regulation_id')->on('lms_g46_complianceregulations');
            $table->foreign('responsible_department')->references('department_id')->on('lms_g46_Compliancedepartments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lms_g46_compliancerequirements');
    }
}
