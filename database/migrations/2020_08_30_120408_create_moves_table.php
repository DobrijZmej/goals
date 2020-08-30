<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    const TABLE_NAME = 'moves';

    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->bigInteger("goal_id")->unsigned()->comment = 'Посилання на ціль';
            $table->timestamp("date")->comment = 'Дата, коли зафіксован рух коштів';
            $table->decimal("amount", 30, 2)->comment = 'Сума руху коштів';
            $table->text("description")->comment = 'Опис руху коштів';
            $table->timestamps();
            $table->foreign('goal_id')->references('id')->on('goals');
        });
        DB::statement("ALTER TABLE `".self::TABLE_NAME."` comment 'Фіксація руху коштів'");
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
