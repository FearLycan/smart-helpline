<?php

use yii\db\Migration;

/**
 * Handles adding update_at to table `file`.
 */
class m170703_093321_add_update_at_column_to_file_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%file}}', 'updated_at', $this->timestamp()->null());

        $this->createIndex('{{%file_updated_at_index}}', '{{%file}}', 'updated_at');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%file}}', 'updated_at');
    }
}
