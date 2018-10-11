<?php

use yii\db\Migration;

/**
 * Handles the creation of table `airline`.
 */
class m181010_154818_create_airline_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%airline}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text()->null(),
            'description' => $this->text()->null(),
            'additional_fields' => $this->text()->null(),
            'author_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('{{%airline_created_at_index}}', '{{%airline}}', 'created_at');
        $this->createIndex('{{%airline_updated_at_index}}', '{{%airline}}', 'updated_at');

        $this->addForeignKey('{{%airline_author_id_fk}}', '{{%airline}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%airline}}');
    }
}
