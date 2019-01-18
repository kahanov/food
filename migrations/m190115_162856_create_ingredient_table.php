<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ingredient`.
 */
class m190115_162856_create_ingredient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ingredient', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'status' => $this->boolean(),
        ]);
        $this->batchInsert('ingredient', ['id', 'name', 'status'], [
            ['1', 'Мука', '1'],
            ['2', 'Чеснок', '1'],
            ['3', 'Зелень', '1'],
            ['4', 'Масло растительное', '1'],
            ['5', 'Вода', '1'],
            ['6', 'Крупа гречневая', '1'],
            ['7', 'Соль', '1'],
            ['8', 'Крупа манная', '1'],
            ['9', 'Молоко', '1'],
            ['10', 'Сахар', '1'],
            ['11', 'Баранина', '1'],
            ['12', 'Рис', '1'],
            ['13', 'Мясо', '1'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ingredient');
    }
}
