<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regulations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('category_id');
            $table->uuid('skpd_id');
            $table->integer('nomor');
            $table->string('tahun');
            $table->text('description');
            $table->string('file');
            $table->date('published_at');
            $table->timestamps();

            //unique
            $table->unique(['category_id', 'skpd_id', 'nomor', 'tahun']);

            // relasi
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('skpd_id')->references('id')->on('skpd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regulations');
    }
}
