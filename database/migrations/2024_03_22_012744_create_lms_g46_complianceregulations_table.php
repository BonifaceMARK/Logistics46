<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLmsG46ComplianceregulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lms_g46_complianceregulations', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('regulation_id')->unique();
            $table->string('title', 255);
            $table->text('description');
            $table->string('jurisdiction', 100);
            $table->string('category', 100);
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
        Schema::dropIfExists('lms_g46_complianceregulations');
    }
}
