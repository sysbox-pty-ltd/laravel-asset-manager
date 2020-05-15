<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Sysbox\LaravelBaseEntity\Facades\LaravelBaseEntity;

class CreateAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            LaravelBaseEntity::addBasicLaravelBaseEntityColumns($table);

            LaravelBaseEntity::addHashIdColumn($table, 'model_id')->index();
            $table->string('model_type', 100)->index();
            $table->text('comments');
            LaravelBaseEntity::addHashIdColumn($table, 'asset_id')->index();

            $table->foreign('asset_id')->references('id')->on('assets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attachments');
    }
}
