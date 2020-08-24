<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->timestamp('published', '0')->after('description');
            $table->string('image_gallery')->after('image')->nullable();
            $table->string('tags')->after('image_gallery')->nullable();
            $table->renameColumn('category', 'categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('categories', 'category');
            $table->dropColumn(['image_gallery', 'tags']);
        });
    }
}
