<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CategorySearch represents the model behind the search form of `app\modules\admin\models\Category`.
 */
class CategorySearch extends Category
{

    public $name;
    public $description;
    public $created_at;
    public $updated_at;
    public $author;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'created_at', 'author', 'updated_at'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $query)
    {
        $query->joinWith(['author author']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['name' => SORT_ASC]],
        ]);

        $dataProvider->sort->attributes['author'] = [
            'asc' => ['author.lastname' => SORT_ASC],
            'desc' => ['author.lastname' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'category.name', $this->name])
            ->andFilterWhere(['like', 'category.description', $this->description])
            ->andFilterWhere(['like', 'category.created_at', $this->created_at])
            ->andFilterWhere(['like', 'category.updated_at', $this->updated_at])
            ->andFilterWhere([
                'or',
                ['like', 'author.name', $this->author],
                ['like', 'author.lastname', $this->author],
            ]);

        return $dataProvider;
    }
}
