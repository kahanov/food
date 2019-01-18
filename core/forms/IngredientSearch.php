<?php

namespace kahanov\food\core\forms;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use kahanov\food\core\entities\Ingredient;

class IngredientSearch extends Model
{
    public $id;
	public $name;
	public $status;

	/**
	 * @return array
	 */
	public function rules(): array
	{
		return [
            [['id', 'status'], 'integer'],
			[['name'], 'safe'],
		];
	}

	/**
	 * @param array $params
	 * @return ActiveDataProvider
	 */
	public function search(array $params): ActiveDataProvider
	{
		$query = Ingredient::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'defaultOrder' => ['name' => SORT_ASC]
			]
		]);
		$this->load($params);
		if (!$this->validate()) {
			$query->where('0=1');
			return $dataProvider;
		}
		$query->andFilterWhere([
			'id' => $this->id,
            'status' => $this->status,
		]);
		$query->andFilterWhere(['like', 'name', $this->name]);
		return $dataProvider;
	}
}
