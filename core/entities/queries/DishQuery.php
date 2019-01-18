<?php

namespace kahanov\food\core\entities\queries;

use yii\db\ActiveQuery;
use kahanov\food\core\entities\Dish;

class DishQuery extends ActiveQuery
{
	/**
	 * @param null $alias
	 * @return DishQuery
	 */
	public function active($alias = null)
	{
		return $this->andWhere([
			($alias ? $alias . '.' : '') . 'status' => Dish::STATUS_ENABLE,
		]);
	}
}
