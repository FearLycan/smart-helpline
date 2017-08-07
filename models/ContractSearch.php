<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contract;

/**
 * ContractSearch represents the model behind the search form of `app\models\Contract`.
 */
class ContractSearch extends Contract
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'author_id'], 'integer'],
            [['airline_name', 'contract_validity_from', 'routing', 'infant_fares', 'ticket_designator', 'tour_code', 'endorsment', 'interline', 'codeshares', 'created_at', 'updated_at', 'contract_validity_to', 'mixed_classes', 'contract_description', 'routing_subcat_1', 'routing_subcat_1_description', 'routing_subcat_2', 'routing_subcat_2_description'], 'safe'],
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'contract_validity_from' => $this->contract_validity_from,
            'author_id' => $this->author_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'contract_validity_to' => $this->contract_validity_to,
        ]);

        $query->andFilterWhere(['like', 'airline_name', $this->airline_name])
            ->andFilterWhere(['like', 'routing', $this->routing])
            ->andFilterWhere(['like', 'infant_fares', $this->infant_fares])
            ->andFilterWhere(['like', 'ticket_designator', $this->ticket_designator])
            ->andFilterWhere(['like', 'tour_code', $this->tour_code])
            ->andFilterWhere(['like', 'endorsment', $this->endorsment])
            ->andFilterWhere(['like', 'interline', $this->interline])
            ->andFilterWhere(['like', 'codeshares', $this->codeshares])
            ->andFilterWhere(['like', 'mixed_classes', $this->mixed_classes])
            ->andFilterWhere(['like', 'contract_description', $this->contract_description])
            ->andFilterWhere(['like', 'routing_subcat_1', $this->routing_subcat_1])
            ->andFilterWhere(['like', 'routing_subcat_1_description', $this->routing_subcat_1_description])
            ->andFilterWhere(['like', 'routing_subcat_2', $this->routing_subcat_2])
            ->andFilterWhere(['like', 'routing_subcat_2_description', $this->routing_subcat_2_description]);

        return $dataProvider;
    }
}
