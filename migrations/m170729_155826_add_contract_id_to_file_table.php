<?php

use yii\db\Migration;

class m170729_155826_add_contract_id_to_file_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%file}}', 'contract_id', $this->integer()->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%file}}', 'contract_id');
    }
}
