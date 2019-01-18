<?php

use yii\db\Migration;

/**
 * Handles the creation of table `dish`.
 */
class m190115_162933_create_dish_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('dish', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'status' => $this->boolean(),
        ]);
        $this->batchInsert('dish', ['name', 'status'], [
            ['Каша манная', '1' ],
            ['Перловка', '1' ],
            ['Хинкал', '1' ],
            ['Гречка', '1' ],
            ['Плов', '1' ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('dish');
    }
}
