<?php

namespace kahanov\food\core\helpers;

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kahanov\food\core\entities\Dish;

class DishHelper
{
	/**
	 * @return array
	 */
	public static function statusList(): array
	{
		return [
            Dish::STATUS_DISABLE => 'Disabled',
            Dish::STATUS_ENABLE => 'Enabled',
		];
	}

	/**
	 * @param $status
	 * @return string
	 */
	public static function statusName($status): string
	{
		return ArrayHelper::getValue(self::statusList(), $status);
	}

	/**
	 * @param $status
	 * @return string
	 */
	public static function statusLabel($status): string
	{
		switch ($status) {
			case Dish::STATUS_DISABLE:
				$class = 'label label-default';
				break;
			case Dish::STATUS_ENABLE:
				$class = 'label label-success';
				break;
			default:
				$class = 'label label-default';
		}
		return Html::tag('span', ArrayHelper::getValue(self::statusList(), $status), [
			'class' => $class,
		]);
	}
}
