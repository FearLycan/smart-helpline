<?php

use yii\db\Migration;

/**
 * Handles the creation of table `folder_category`.
 */
class m181023_101834_create_folder_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%folder_category}}', [
            'folder_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('{{%folder_category_pk}}', '{{%folder_category}}', ['folder_id', 'category_id']);
        $this->addForeignKey('{{%folder_category_folder_id_fk}}', '{{%folder_category}}', 'folder_id', '{{%folder}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('{{%folder_category_category_id_fk}}', '{{%folder_category}}', 'category_id', '{{%category}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%folder_category}}');
    }
}
