<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegulationChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulation_changes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('modifier_id');
            $table->uuid('changed_id');
            /*
                Isian pada field status
                1 => Mengubah
                2 => Mencabut
            */
            $table->boolean('status');
            $table->timestamps();

            //unique
            $table->unique(['modifier_id', 'changed_id', 'status']);

            // relasi
            $table->foreign('modifier_id')->references('id')->on('regulations');
            $table->foreign('changed_id')->references('id')->on('regulations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regulation_changes');
    }
}
