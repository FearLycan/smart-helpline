<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_after_hours`.
 */
class m180415_130042_create_user_after_hours_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_after_hours}}', [
            'user_id' => $this->integer()->notNull(),
            'hour_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%user_hours_pk}}', '{{%user_after_hours}}', ['user_id', 'hour_id']);
        $this->addForeignKey('{{%user_hours_user_id_fk}}', '{{%user_after_hours}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%user_hours_id_fk}}', '{{%user_after_hours}}', 'hour_id', '{{%after_hours}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('{{%user_hours_user_id_fk}}', '{{%user_after_hours}}');
        $this->dropForeignKey('{{%user_hours_id_fk}}', '{{%user_after_hours}}');
        $this->dropTable('{{%user_after_hours}}');
    }
}
