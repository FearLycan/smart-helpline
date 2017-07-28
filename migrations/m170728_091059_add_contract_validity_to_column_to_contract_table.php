<?php

use yii\db\Migration;

/**
 * Handles adding contract_validity_to to table `contract`.
 */
class m170728_091059_add_contract_validity_to_column_to_contract_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%contract}}', 'contract_validity_to', $this->timestamp()->notNull());

        $this->createIndex('{{%contract_validity_to_index}}', '{{%contract}}', 'contract_validity_to');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('{{%contract_validity_to_index}}', '{{%contract}}');
        $this->dropColumn('{{%contract}}', 'contract_validity_to');
    }
}
