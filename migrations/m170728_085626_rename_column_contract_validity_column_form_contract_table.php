<?php

use yii\db\Migration;

class m170728_085626_rename_column_contract_validity_column_form_contract_table extends Migration
{
    public function safeUp()
    {
        $this->dropIndex('{{%contract_ucontract_validity_index}}', '{{%contract}}');
        $this->renameColumn('{{%contract}}', 'contract_validity', 'contract_validity_from');
        $this->createIndex('{{%contract_validity_index}}', '{{%contract}}', 'contract_validity_from');
    }

    public function safeDown()
    {
        $this->dropIndex('{{%contract_validity_index}}', '{{%contract}}');
        $this->renameColumn('{{%contract}}', 'contract_validity_form', 'contract_validity');
        $this->createIndex('{{%contract_ucontract_validity_index}}', '{{%contract}}', 'contract_validity');
    }
}
