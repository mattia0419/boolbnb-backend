<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->smallInteger('rooms')->unsigned()->nullable();
            $table->smallInteger('beds')->unsigned()->nullable();
            $table->smallInteger('bathrooms')->unsigned()->nullable();
            $table->smallInteger('square_meters')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->decimal('longitude',11,8)->nullable();
            $table->decimal('latitude',10,8)->nullable();
            $table->decimal('price',12,2)->unsigned()->nullable();
            $table->boolean('visible')->default(false);
            $table->text('cover_img');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');


        // Schema::table('apartments', function (Blueprint $table){
        //     $table->dropSoftDeletes();

        // });
    }
};