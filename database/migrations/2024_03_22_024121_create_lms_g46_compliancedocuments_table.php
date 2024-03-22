<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLmsG46CompliancedocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_g46_compliancedocuments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('document_id')->unique();
            $table->string('title', 255);
            $table->string('document_type', 100);
            $table->string('file_path', 255);
            $table->date('upload_date');
            $table->date('expiration_date')->nullable();
            $table->unsignedInteger('related_regulation_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('related_regulation_id')->references('regulation_id')->on('lms_g46_complianceregulations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lms_g46_compliancedocuments');
    }
}
