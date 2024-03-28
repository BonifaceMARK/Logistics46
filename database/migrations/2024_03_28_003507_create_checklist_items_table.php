<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChecklistItemsTable extends Migration
{
    public function up()
    {
        Schema::create('checklist_items', function (Blueprint $table) {
            $table->id();
            $table->string('department')->nullable();
            $table->string('item');
            $table->string('status')->default('Pending'); // Added status field with default value 'Pending'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('checklist_items');
    }
}
