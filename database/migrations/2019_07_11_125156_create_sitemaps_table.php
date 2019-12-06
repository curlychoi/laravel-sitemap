<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitemapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitemaps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('loc')->unique();
            $table->string('changefreq', 5)->default('daily');
            $table->string('priority')->default('0.8');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sitemaps');
    }
}
