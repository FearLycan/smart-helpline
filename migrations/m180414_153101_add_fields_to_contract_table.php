<?php

use yii\db\Migration;

class m180414_153101_add_fields_to_contract_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%contract}}', 'additional_fields', $this->text()->null());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%contract}}', 'additional_fields');
    }
}
