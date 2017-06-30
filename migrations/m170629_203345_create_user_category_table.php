<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_category`.
 */
class m170629_203345_create_user_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_category}}', [
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%user_category_pk}}', '{{%user_category}}', ['user_id', 'category_id']);
        $this->addForeignKey('{{%user_category_user_id_fk}}', '{{%user_category}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%user_category_category_id_fk}}', '{{%user_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%user_category_user_id_fk}}', '{{%user_category}}');
        $this->dropForeignKey('{{%user_category_category_id_fk}}', '{{%user_category}}');
        $this->dropTable('{{%user_category}}');
    }
}
