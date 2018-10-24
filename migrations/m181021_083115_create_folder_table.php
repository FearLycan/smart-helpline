<?php

use yii\db\Migration;

/**
 * Handles the creation of table `folder`.
 */
class m181021_083115_create_folder_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%folder}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string()->null(),
            'parent_id' => $this->integer()->null(),
            'author_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('{{%folder_created_at_index}}', '{{%folder}}', 'created_at');
        $this->createIndex('{{%folder_updated_at_index}}', '{{%folder}}', 'updated_at');

        $this->addForeignKey('{{%folder_author_id_fk}}', '{{%folder}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%folder}}');
    }
}
