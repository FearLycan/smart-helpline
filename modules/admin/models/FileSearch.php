<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * FileSearch represents the model behind the search form of `app\modules\admin\models\File`.
 */
class FileSearch extends File
{
    public $author;
    public $category;
    public $name;
    public $format;
    public $created_at;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'format', 'created_at', 'author', 'category'], 'string'],
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
     * @return ActiveDataProvider
     */
    public function search($params, $query)
    {
        $query->joinWith(['author author', 'category category']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['author'] = [
            'asc' => ['author.lastname' => SORT_ASC],
            'desc' => ['author.lastname' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['category'] = [
            'asc' => ['category.name' => SORT_ASC],
            'desc' => ['category.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'file.name', $this->name])
            ->andFilterWhere(['like', 'file.real_name', $this->real_name])
            ->andFilterWhere(['like', 'file.format', $this->format])
            ->andFilterWhere(['like', 'category.name', $this->category])
            ->andFilterWhere(['like', 'file.created_at', $this->created_at])
            ->andFilterWhere([
                'or',
                ['like', 'author.name', $this->author],
                ['like', 'author.lastname', $this->author],
            ]);

        return $dataProvider;
    }
}
