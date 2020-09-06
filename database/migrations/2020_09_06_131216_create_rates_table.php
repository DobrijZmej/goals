<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    const TABLE_NAME = 'rates';

    public function up()
    {
        /* Спецификация согласно сервисов НБУ https://bank.gov.ua/ua/open-data/api-dev */
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->integer("code")->unsigned()->comment = 'Код валюти (r030)';
            $table->text("short_name", 3)->comment = 'Коротка назва валюти';
            $table->text("name")->comment = 'Назва валюти';
            $table->decimal("rate", 30, 8)->comment = 'Курс';
            $table->timestamp("date")->comment = 'Дата, за яку встановлено курс';
            $table->timestamps();
        });
        DB::statement("create UNIQUE INDEX uniq_code_date ON ".self::TABLE_NAME."(code, date);");
        DB::statement("ALTER TABLE `".self::TABLE_NAME."` comment 'Курси валют від НБУ'");
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
