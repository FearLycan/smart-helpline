<?php

use yii\db\Migration;

class m170728_101248_add_cotract_description_to_contract_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%contract}}', 'contract_description', $this->string()->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%contract}}', 'contract_description');
    }

}
