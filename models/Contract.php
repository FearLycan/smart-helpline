<?php

namespace app\models;


/**
 * This is the model class for table "{{%contract}}".
 *
 * @property int $id
 * @property string $airline_name
 * @property string $contract_validity_from
 * @property string $contract_validity_to
 * @property string $routing
 * @property string $infant_fares
 * @property string $ticket_designator
 * @property string $tour_code
 * @property string $endorsment
 * @property string $mixed_classes
 * @property string $interline
 * @property string $codeshares
 * @property int $author_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $note
 * @property string $contract_description
 * @property string $routing_subcat_1
 * @property string $routing_subcat_1_description
 * @property string $routing_subcat_2
 * @property string $routing_subcat_2_description
 * @property string $additional_fields
 *
 * @property User $author
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contract}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['airline_name', 'routing', 'infant_fares', 'ticket_designator', 'tour_code', 'endorsment', 'interline', 'codeshares'], 'required'],
            [['contract_validity_from', 'contract_validity_to', 'created_at', 'updated_at'], 'safe'],
            [['author_id'], 'integer'],
            [[
                'routing_subcat_1', 'routing_subcat_1', 'routing_subcat_1_description','routing_subcat_2_description', 'mixed_classes', 'airline_name', 'routing', 'infant_fares', 'ticket_designator',
                'tour_code', 'endorsment', 'interline', 'codeshares', 'note', 'additional_fields'
            ], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'airline_name' => 'Airline Name',
            'contract_validity_from' => 'Contract Validity From',
            'contract_validity_to' => 'Contract Validity To',
            'routing' => 'Routing',
            'infant_fares' => 'Infant Fares',
            'ticket_designator' => 'Ticket Designator',
            'tour_code' => 'Tour Code',
            'endorsment' => 'Endorsment',
            'mixed_classes' => 'Mixed Classes',
            'interline' => 'Interline',
            'codeshares' => 'Codeshares',
            'author_id' => 'Author ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'contract_description' => 'Contract Description',
            'note' => 'Additional Notes',
            'additional_fields' => 'Additional Fields',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinkedUsers()
    {
        return $this->hasMany(UserContract::className(), ['contract_id' => 'id']);
    }

    /**
     * @return mixed
     */
    public function getAdditionalFields()
    {
        return json_decode($this->additional_fields, true);
    }

    /**
     * @param $value
     */
    public function setAdditionalFields($value)
    {
        $this->additional_fields = json_encode($value);
    }
}
