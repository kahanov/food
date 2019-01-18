<?php

namespace kahanov\food\core\entities;

use yii\db\ActiveRecord;

/**
 * The Ingredient entity
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 */
class Ingredient extends ActiveRecord
{
    const STATUS_DISABLE = 0;
    const STATUS_ENABLE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%ingredient}}';
    }

    public function enable(): void
    {
        $this->status = self::STATUS_ENABLE;
    }

    public function disable(): void
    {
        $this->status = self::STATUS_DISABLE;
    }
}
