<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%contract}}".
 *
 * @property int $id
 * @property string $airline_name
 * @property string $contract_validity
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
            [['contract_validity', 'created_at', 'updated_at'], 'safe'],
            [['mixed_classes'], 'number'],
            [['author_id'], 'integer'],
            [['airline_name', 'routing', 'infant_fares', 'ticket_designator', 'tour_code', 'endorsment', 'interline', 'codeshares'], 'string', 'max' => 255],
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
            'contract_validity' => 'Contract Validity',
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }
}
