<?php

use yii\db\Migration;

class m170728_093105_change_mixed_classes_type_in_contract_table extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('{{%contract}}', 'mixed_classes');
        $this->addColumn('{{%contract}}', 'mixed_classes', $this->string()->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%contract}}', 'mixed_classes');
        $this->addColumn('{{%contract}}', 'mixed_classes', $this->string()->null());
    }
}
