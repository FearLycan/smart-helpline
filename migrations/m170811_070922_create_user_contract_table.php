<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_contract`.
 */
class m170811_070922_create_user_contract_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_contract}}', [
            'user_id' => $this->integer()->notNull(),
            'contract_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%user_contract_pk}}', '{{%user_contract}}', ['user_id', 'contract_id']);
        $this->addForeignKey('{{%user_contract_user_id_fk}}', '{{%user_contract}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%user_contract_contract_id_fk}}', '{{%user_contract}}', 'contract_id', '{{%contract}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%user_contract_user_id_fk}}', '{{%user_contract}}');
        $this->dropForeignKey('{{%user_contract_contract_id_fk}}', '{{%user_contract}}');
        $this->dropTable('{{%user_contract}}');
    }
}
