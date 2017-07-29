<?php

use yii\db\Migration;

class m170729_133545_add_fields_to_contract_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%contract}}', 'routing_subcat_1', $this->string()->null());
        $this->addColumn('{{%contract}}', 'routing_subcat_1_description', $this->string()->null());
        $this->addColumn('{{%contract}}', 'routing_subcat_2', $this->string()->null());
        $this->addColumn('{{%contract}}', 'routing_subcat_2_description', $this->string()->null());
    }

    public function safeDown()
    {
        $this->dropColumn('{{%contract}}', 'routing_subcat_1');
        $this->dropColumn('{{%contract}}', 'routing_subcat_1_description');
        $this->dropColumn('{{%contract}}', 'routing_subcat_2');
        $this->dropColumn('{{%contract}}', 'routing_subcat_2_description');
    }

}
