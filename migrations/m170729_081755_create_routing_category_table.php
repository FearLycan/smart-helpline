<?php

use yii\db\Migration;

/**
 * Handles the creation of table `routing_category`.
 */
class m170729_081755_create_routing_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%routing_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'description' => $this->string()->null(),
            'author_id' => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('{{%routing_category_created_at_index}}', '{{%routing_category}}', 'created_at');
        $this->createIndex('{{%routing_category_updated_at_index}}', '{{%routing_category}}', 'updated_at');

        $this->addForeignKey('{{%routing_category_author_id_fk}}', '{{%routing_category}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%routing_category}}');
    }
}
