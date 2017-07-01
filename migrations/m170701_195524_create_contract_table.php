<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contract`.
 */
class m170701_195524_create_contract_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%contract}}', [
            'id' => $this->primaryKey(),
            'airline_name' => $this->string()->notNull(),
            'contract_validity' => $this->timestamp()->notNull(),
            'routing' => $this->string()->notNull(),
            'infant_fares' => $this->string()->notNull(),
            'ticket_designator' => $this->string()->notNull(),
            'tour_code' => $this->string()->notNull(),
            'endorsment' => $this->string()->notNull(),
            'mixed_classes' => $this->decimal(4, 2),
            'interline' => $this->string()->notNull(),
            'codeshares' => $this->string()->notNull(),
            'author_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('{{%contractr_created_at_index}}', '{{%contract}}', 'created_at');
        $this->createIndex('{{%contract_updated_at_index}}', '{{%contract}}', 'updated_at');
        $this->createIndex('{{%contract_ucontract_validity_index}}', '{{%contract}}', 'contract_validity');

        $this->addForeignKey('{{%contract_author_id_fk}}', '{{%contract}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%contract}}');
    }
}
