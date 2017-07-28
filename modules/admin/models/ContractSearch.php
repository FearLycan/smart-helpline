<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ContractSearch represents the model behind the search form of `app\modules\admin\models\Contract`.
 */
class ContractSearch extends Contract
{
    public $author;
    public $airline_name;
    public $contract_validity_from;
    public $contract_validity_to;
    public $routing;
    public $infant_fares;
    public $ticket_designator;
    public $tour_code;
    public $endorsment;
    public $interline;
    public $codeshares;
    public $created_at;
    public $updated_at;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['airline_name', 'author', 'contract_validity_from', 'contract_validity_to', 'routing', 'infant_fares', 'ticket_designator', 'tour_code',
                'endorsment', 'interline', 'codeshares', 'created_at', 'updated_at'], 'string'],
            [['mixed_classes'], 'number'],
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
    public function search($params)
    {
        $query = Contract::find();

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

        $query->andFilterWhere(['like', 'airline_name', $this->airline_name])
            ->andFilterWhere(['like', 'routing', $this->routing])
            ->andFilterWhere(['like', 'infant_fares', $this->infant_fares])
            ->andFilterWhere(['like', 'ticket_designator', $this->ticket_designator])
            ->andFilterWhere(['like', 'tour_code', $this->tour_code])
            ->andFilterWhere(['like', 'endorsment', $this->endorsment])
            ->andFilterWhere(['like', 'interline', $this->interline])
            ->andFilterWhere(['like', 'codeshares', $this->codeshares])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'contract_validity_from', $this->contract_validity_from])
            ->andFilterWhere(['like', 'contract_validity_to', $this->contract_validity_to])
            ->andFilterWhere([
                'or',
                ['like', 'author.name', $this->author],
                ['like', 'author.lastname', $this->author],
            ]);

        return $dataProvider;
    }
}
