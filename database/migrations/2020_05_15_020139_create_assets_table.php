<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sysbox\LaravelBaseEntity\Facades\LaravelBaseEntity;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            LaravelBaseEntity::addBasicLaravelBaseEntityColumns($table);

            $table->string('file_name', 255);
            $table->string('file_path', 255);
            $table->string('mime_type', 100);
            $table->bigInteger('file_size');
            LaravelBaseEntity::addHashIdColumn($table, 'type_id')->index();

            $table->foreign('type_id')->references('id')->on('assetTypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
