<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreFieldsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->index()->after('id');
            $table->dateTime('publish_at')->nullable()->after('body');
            $table->dateTime('publish_until')->nullable()->after('body');
            $table->boolean('is_published')->default(false)->after('body');
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
            $table->dropColumn('category_id');
            $table->dropColumn('publish_at');
            $table->dropColumn('publish_until');
            $table->dropColumn('is_published');
        });
    }
}
