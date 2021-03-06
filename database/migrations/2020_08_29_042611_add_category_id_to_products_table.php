<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // este codigo puede ser usado en caso de no querer afectar a otros
        $category = App\Category::create([
            'name' => 'Otros'
        ]);

        Schema::table('products', function (Blueprint $table) use($category){
            $table->unsignedBigInteger('category_id')->default($category->id);

            $table->foreign('category_id')->reference('id')->on('category');
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
            $table->dropColumn('category_id');
        });
    }
}
