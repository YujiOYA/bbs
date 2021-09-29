<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmTable extends Migration
{
    /**
     Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('confirms_id', false, 10)->nullable();
            /**
            $table->foreign('confirms_id')
            ->references('id')->on('confirms')
            ->onCreate('Cascade')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_confirms_id_foreign');
        });
    }
}
