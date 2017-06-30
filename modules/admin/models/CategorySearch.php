<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * CategorySearch represents the model behind the search form of `app\modules\admin\models\Category`.
 */
class CategorySearch extends Category
{

    public $author;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['name', 'description', 'created_at', 'author', 'updated_at'], 'safe'],
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

        // grid filtering conditions
        $query->andFilterWhere([
            'author.lastname' => $this->author,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere([
                'or',
                ['like', 'author.name', $this->author],
                ['like', 'author.lastname', $this->author],
            ]);

        return $dataProvider;
    }
}
