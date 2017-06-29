<?php

use yii\db\Migration;

/**
 * Handles the creation of table `file`.
 *
 * @author Damian Brończyk <damian.bronczyk@gmail.com.pl>
 */
class m170628_124217_create_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'real_name' => $this->string(),
            'format' => $this->string(),
            'category_id' => $this->integer(),
            'author_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('{{%file_created_at_index}}', '{{%file}}', 'created_at');

        $this->addForeignKey('{{%file_author_id_fk}}', '{{%file}}', 'author_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%file}}');
    }
}
