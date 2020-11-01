<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    const TABLE_NAME = 'currency';

    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->integer("code")->unsigned()->comment = 'Код валюти (r030)';
            $table->text("short_name", 3)->comment = 'Коротка назва валюти';
            $table->text("name")->comment = 'Назва валюти';
            $table->integer("is_enabled")->unsigned()->default(0)->comment = 'Доступна/заборонена';
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
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
