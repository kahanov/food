<?php

use yii\db\Migration;

/**
 * Handles the creation of table `ingredient_assignment`.
 */
class m190116_081454_create_ingredient_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('ingredient_assignment', [
            'dish_id' => $this->integer()->notNull(),
            'ingredient_id' => $this->integer()->notNull(),
        ]);
        $this->addPrimaryKey('pk-ingredient_assignment', 'ingredient_assignment', ['dish_id', 'ingredient_id']);
        $this->createIndex('idx-ingredient_assignment-dish_id', 'ingredient_assignment', 'dish_id');
        $this->createIndex('idx-ingredient_assignment-ingredient_id', 'ingredient_assignment', 'ingredient_id');
        $this->addForeignKey('fk-ingredient_assignment-dish_id', 'ingredient_assignment', 'dish_id', 'dish', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-ingredient_assignment-ingredient_id', 'ingredient_assignment', 'ingredient_id', 'ingredient', 'id', 'CASCADE', 'RESTRICT');
        $this->batchInsert('ingredient_assignment', ['dish_id', 'ingredient_id'], [
            ['1', '8'],
            ['1', '9'],
            ['1', '10'],
            ['1', '7'],
            ['1', '13'],
            ['4', '7'],
            ['4', '4'],
            ['4', '5'],
            ['4', '6'],
            ['5', '12'],
            ['5', '11'],
            ['5', '7'],
            ['3', '13'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('ingredient_assignment');
    }
}
