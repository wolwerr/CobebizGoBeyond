<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChilliBeans extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vision', function (Blueprint $table) {
            $table->integer('productId');
            $table->string('productName', 120);
            $table->string('brand', 100);
            $table->timestamps();
        });

    }
    protected $connection = 'mysql';
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vision');
    }
}
