<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sysbox\LaravelBaseEntity\Facades\LaravelBaseEntity;

class CreateAssetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetTypes', function (Blueprint $table) {
            LaravelBaseEntity::addBasicLaravelBaseEntityColumns($table);
            $table->string('name', 100)->unique()->index();
            $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assetTypes');
    }
}
