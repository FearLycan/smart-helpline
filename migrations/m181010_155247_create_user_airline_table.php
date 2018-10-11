<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_airline`.
 */
class m181010_155247_create_user_airline_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user_airline}}', [
            'user_id' => $this->integer()->notNull(),
            'airline_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%user_airline_pk}}', '{{%user_airline}}', ['user_id', 'airline_id']);
        $this->addForeignKey('{{%user_airline_user_id_fk}}', '{{%user_airline}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%user_airline_airline_id_fk}}', '{{%user_airline}}', 'airline_id', '{{%airline}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%user_airline}}');
    }
}
