<?php

use yii\db\Migration;

/**
 * Handles the creation of table `after_hours`.
 */
class m180415_124149_create_after_hours_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%after_hours}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->null(),
            'description' => $this->text()->null(),
            'additional_fields' => $this->text()->null(),
            'author_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('{{%after_hours_created_at_index}}', '{{%after_hours}}', 'created_at');
        $this->createIndex('{{%after_hours_updated_at_index}}', '{{%after_hours}}', 'updated_at');

        $this->addForeignKey('{{%after_hours_author_id_fk}}', '{{%after_hours}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%after_hours}}');
    }
}
