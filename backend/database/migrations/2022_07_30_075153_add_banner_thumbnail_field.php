<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBannerThumbnailField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('banner')->after('photo');
            $table->string('thumbnail')->after('banner');
            $table->string('bannerCoordinates')->after('thumbnail');
            $table->string('thumbnailCoordinates')->after('bannerCoordinates');
        });

    }

    /*
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
